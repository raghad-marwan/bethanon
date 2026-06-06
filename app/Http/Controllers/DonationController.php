<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Notification;
use App\Models\Appeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DonationController extends Controller
{
    public function index()
    {
        $today = Donation::whereDate('created_at', Carbon::today())
            ->where('status', 'confirmed')
            ->sum('amount');

        $thisMonth = Donation::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->where('status', 'confirmed')
            ->sum('amount');

        $total = Donation::where('status', 'confirmed')->sum('amount');

        $dailyTarget = 5000;
        $todayPercent = $dailyTarget > 0 ? min(($today / $dailyTarget) * 100, 100) : 0;

        $stats = [
            'total' => $total,
            'today' => $today,
            'this_month' => $thisMonth,
            'count_today' => Donation::whereDate('created_at', Carbon::today())->where('status', 'confirmed')->count(),
            'daily_target' => $dailyTarget,
            'today_percent' => round($todayPercent, 1),
        ];

        $recentDonations = Donation::where('status', 'confirmed')->latest()->take(5)->get();
        $notifications = Notification::latest()->take(3)->get();
       $urgentAppeals = Appeal::where('status', 'approved')
    ->whereColumn('current_amount', '<', 'target_amount')
    ->latest()->take(3)->get();

return view('index', compact('stats', 'recentDonations', 'notifications', 'urgentAppeals'));    }

    public function showDonateForm()
    {
        $paymentMethods = [
            'usdt' => ['address' => 'TXxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'network' => 'TRC20'],
            'bank' => ['name' => 'محفظة ', 'iban' => 'PS12BANK000000000000000000000', 'bank_name' => ' محفظة', 'account_name' => 'صندوق مساعدة الناس - بيت حانون'],
        ];

        $goals = ['sustainable' => 'مشاريع مستدامة', 'relief' => 'إغاثية', 'orphans' => 'أيتام', 'health' => 'صحية', 'other' => 'أخرى'];

        return view('donate', compact('paymentMethods', 'goals'));
    }

    public function storeDonation(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:usdt,bank',
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
