<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Appeal;
use App\Models\Notification;
use App\Models\Withdrawal;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Expense;
use App\Mail\OrganizationApproved;
use App\Mail\DonationRejected;
use App\Mail\DonationApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AdminController extends Controller
{
    // ==================== الإحصائيات ====================
    public function statistics()
    {
        return view('admin.statistics.index');
    }

    // ==================== التبرعات ====================
    public function donations()
    {
        $donations = Donation::where('status', 'confirmed')->latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    public function donationsMonthly()
    {
        $donations = Donation::where('status', 'confirmed')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->latest()->paginate(20);
        return view('admin.donations.monthly', compact('donations'));
    }

    public function donationsPending()
    {
        return view('admin.donations.pending');
    }

    public function confirmDonation($id)
    {
        $donation = Donation::find($id);
        if ($donation) {
            $donation->update(['status' => 'confirmed']);
            if ($donation->appeal_id) {
                $appeal = Appeal::find($donation->appeal_id);
                if ($appeal) {
                    $appeal->update(['current_amount' => $appeal->current_amount + $donation->amount]);
                }
            }
            if ($donation->organization_id && $donation->organization) {
                Mail::to($donation->organization->email)->send(new DonationApproved($donation));
            }
        }
        return back()->with('success', 'تم تأكيد التبرع');
    }

    public function rejectDonation($id)
    {
        $donation = Donation::find($id);
        $donation->update(['status' => 'rejected']);
        if ($donation->organization_id && $donation->organization) {
            Mail::to($donation->organization->email)->send(new DonationRejected($donation));
        }
        return back()->with('success', 'تم رفض التبرع');
    }

    // ==================== المناشدات ====================
    public function appeals()
    {
        return view('admin.appeals.index');
    }

    public function createAppeal()
    {
        return view('admin.appeals.create');
    }

    public function storeAppeal(Request $request)
    {
        Appeal::create([
            'title' => $request->title,
            'description' => $request->description,
            'target_amount' => $request->target_amount,
            'current_amount' => $request->current_amount ?? 0,
            'is_urgent' => $request->has('is_urgent'),
            'status' => 'approved',
        ]);
        return redirect('/admin/dashboard')->with('success', 'تم إضافة المناشدة');
    }

    public function deleteAppeal($id)
    {
        Appeal::destroy($id);
        return back()->with('success', 'تم حذف المناشدة');
    }

    public function approveAppeal($id)
    {
        Appeal::find($id)->update(['status' => 'approved']);
        return back()->with('success', 'تمت الموافقة');
    }

    public function rejectAppeal($id)
    {
        Appeal::find($id)->update(['status' => 'rejected']);
        return back()->with('success', 'تم الرفض');
    }

    // ==================== الإشعارات ====================
    public function notifications()
    {
        return view('admin.notifications.index');
    }

    public function storeNotification(Request $request)
    {
        Notification::create(['title' => $request->title, 'message' => $request->message]);
        return redirect('/admin/dashboard')->with('success', 'تم إضافة الإشعار');
    }

    public function deleteNotification($id)
    {
        Notification::destroy($id);
        return back()->with('success', 'تم حذف الإشعار');
    }

    // ==================== المسحوبات ====================
    public function withdrawals()
    {
        return view('admin.withdrawals.index');
    }

    public function storeWithdrawal(Request $request)
    {
        Withdrawal::create([
            'amount' => $request->amount,
            'reason' => $request->reason,
            'note' => $request->note,
        ]);
        return back()->with('success', 'تم تسجيل السحب');
    }

    // ==================== المؤسسات ====================
    public function organizations()
    {
        return view('admin.organizations.index');
    }

    public function approveOrganization($id)
    {
        $org = Organization::find($id);
        $org->update(['status' => 'approved']);
        Mail::to($org->email)->send(new OrganizationApproved($org));
        return back()->with('success', 'تمت الموافقة وإرسال إيميل للمؤسسة');
    }

    public function rejectOrganization($id)
    {
        Organization::find($id)->update(['status' => 'rejected']);
        return back()->with('success', 'تم رفض المؤسسة');
    }

    // ==================== المشاريع ====================
    public function projects()
    {
        $projects = Project::latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function storeProject(Request $request)
    {
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'budget' => $request->budget,
            'status' => $request->status ?? 'planned',
            'start_date' => $request->start_date,
        ]);
        return back()->with('success', 'تم إضافة المشروع');
    }

    public function completeProject($id)
    {
        Project::find($id)->update(['status' => 'completed']);
        return back()->with('success', 'تم تحديث حالة المشروع');
    }

    public function deleteProject($id)
    {
        Project::destroy($id);
        return back()->with('success', 'تم حذف المشروع');
    }

    // ==================== المصروفات ====================
    public function expenses()
    {
        $expenses = Expense::with('project')->latest()->get();
        $projects = Project::all();
        return view('admin.expenses.index', compact('expenses', 'projects'));
    }

    public function storeExpense(Request $request)
    {
        Expense::create([
            'project_id' => $request->project_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'expense_date' => $request->expense_date ?? now(),
        ]);
        return back()->with('success', 'تم إضافة المصروف');
    }
}
