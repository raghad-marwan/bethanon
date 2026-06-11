<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Notification;
use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Project;

class DonationController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Expense::sum('amount'), // إجمالي المصروفات
            'today' => Project::where('status', 'completed')->count(), // عدد المشاريع المنفذة
            'this_month' => Expense::whereMonth('expense_date', Carbon::now()->month)
                ->whereYear('expense_date', Carbon::now()->year)
                ->sum('amount'), // مصروفات هذا الشهر
            'count_today' => Donation::whereDate('created_at', Carbon::today())
                ->where('status', 'confirmed')->count(),
            'daily_target' => 5000,
            'today_percent' => 0,
        ];

        $recentDonations = Donation::where('status', 'confirmed')->latest()->take(5)->get();
        $notifications = Notification::latest()->take(3)->get();
        $urgentAppeals = Appeal::where('status', 'approved')
            ->whereColumn('current_amount', '<', 'target_amount')
            ->latest()->take(3)->get();

        return view('index', compact('stats', 'recentDonations', 'notifications', 'urgentAppeals'));
    }

    public function showDonateForm()
    {
        $paymentMethods = [
            'binance' => [
                'name' => 'محفظة بايننس',
                'iban' => 'TLC9NeahsdSP77Wj37vRTj11oyyHQQKD5Y',
                'bank_name' => 'محفظة بايننس',
                'account_name' => 'صندوق مساعدة الناس - بيت حانون',
            ],
            'maltchat' => [
                'name' => 'محفظة مالتشات',
                'iban' => '0594394229',
                'bank_name' => 'محفظة مالتشات',
                'account_name' =>  'صندوق بيت حانون تاتكافلي المستدام',
            ],
        ];

        $goals = ['sustainable' => 'مشاريع مستدامة', 'relief' => 'إغاثية', 'orphans' => 'أيتام', 'health' => 'صحية', 'other' => 'أخرى'];

        return view('donate', compact('paymentMethods', 'goals'));
    }

    public function storeDonation(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:binance,maltchat',
            'amount' => 'required|numeric|min:1',
            'donation_goal' => 'required|string',
            'donor_visibility' => 'required|in:public,anonymous',
            'donor_name' => 'nullable|string|max:255',
            'receipt' => 'required|image|max:2048',
        ]);

        $data = [
            'donor_name' => $request->donor_visibility === 'anonymous' ? 'فاعل خير' : ($request->donor_name ?? 'فاعل خير'),
            'amount' => $request->amount,
            'anonymous' => $request->donor_visibility === 'anonymous',
            'payment_method' => $request->payment_method,
            'purpose' => $request->donation_goal,
            'status' => 'pending',
            'appeal_id' => $request->appeal_id ?? null,
            'organization_id' => Auth::guard('organization')->check() ? Auth::guard('organization')->id() : null,
        ];

        if ($request->hasFile('receipt')) {
            $data['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        Donation::create($data);

        return redirect()->route('donate')->with('success', 'تم إرسال تبرعك للمراجعة، شكراً لك!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'anonymous' => 'boolean',
            'payment_method' => 'nullable|string',
            'purpose' => 'nullable|string',
            'receipt' => 'nullable|image|max:2048',
        ]);

        $data = [
            'donor_name' => $request->donor_name,
            'amount' => $request->amount,
            'anonymous' => $request->anonymous ?? false,
            'payment_method' => $request->payment_method,
            'purpose' => $request->purpose,
            'status' => 'pending',
            'organization_id' => Auth::guard('organization')->check() ? Auth::guard('organization')->id() : null,
        ];

        if ($request->hasFile('receipt')) {
            $data['receipt'] = $request->file('receipt')->store('receipts', 'public');
        }

        Donation::create($data);

        return response()->json(['message' => 'تم إرسال تبرعك للمراجعة، شكراً لك!'], 201);
    }
}
