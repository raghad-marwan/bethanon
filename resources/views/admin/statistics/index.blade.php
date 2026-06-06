<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الإحصائيات - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 1100px; margin: 25px auto; padding: 0 20px; }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 25px; }
        .stat-card { background: white; padding: 20px; border-radius: 14px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .stat-card i { font-size: 30px; margin-bottom: 8px; }
        .stat-card h3 { font-size: 28px; color: #0c392b; }
        .stat-card p { color: #666; font-size: 13px; margin-top: 4px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); margin-bottom: 25px; }
        .panel h2 { color: #0c392b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; }
        .empty { text-align: center; padding: 30px; color: #999; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>📊 الإحصائيات الكاملة</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        @php
            $totalDonations = \App\Models\Donation::where('status', 'confirmed')->sum('amount');
            $totalWithdrawals = \App\Models\Withdrawal::sum('amount');
            $todayDonations = \App\Models\Donation::whereDate('created_at', \Carbon\Carbon::today())->where('status', 'confirmed')->sum('amount');
            $monthDonations = \App\Models\Donation::whereMonth('created_at', \Carbon\Carbon::now()->month)->where('status', 'confirmed')->sum('amount');
            $pendingCount = \App\Models\Donation::where('status', 'pending')->count();
            $appealsCount = \App\Models\Appeal::count();
            $orgsCount = \App\Models\Organization::where('status', 'approved')->count();
            $donorsCount = \App\Models\Donation::where('status', 'confirmed')->distinct('donor_name')->count();
        @endphp

        <div class="stats">
            <div class="stat-card"><i class="fa-solid fa-hand-holding-heart" style="color:#166534;"></i><h3>{{ number_format($totalDonations - $totalWithdrawals) }}</h3><p>الصافي (شيكل)</p></div>
            <div class="stat-card"><i class="fa-solid fa-calendar-day" style="color:#1e40af;"></i><h3>{{ number_format($todayDonations) }}</h3><p>تبرعات اليوم</p></div>
            <div class="stat-card"><i class="fa-solid fa-calendar-check" style="color:#9a3412;"></i><h3>{{ number_format($monthDonations) }}</h3><p>تبرعات الشهر</p></div>
            <div class="stat-card"><i class="fa-solid fa-clock" style="color:#6b21a8;"></i><h3>{{ $pendingCount }}</h3><p>قيد المراجعة</p></div>
        </div>

        <div class="stats" style="grid-template-columns: repeat(4, 1fr);">
            <div class="stat-card"><i class="fa-solid fa-users" style="color:#0c392b;"></i><h3>{{ $donorsCount }}</h3><p>عدد المتبرعين</p></div>
            <div class="stat-card"><i class="fa-solid fa-bullhorn" style="color:#e65100;"></i><h3>{{ $appealsCount }}</h3><p>المناشدات</p></div>
            <div class="stat-card"><i class="fa-solid fa-building-ngo" style="color:#1a237e;"></i><h3>{{ $orgsCount }}</h3><p>المؤسسات</p></div>
            <div class="stat-card"><i class="fa-solid fa-money-bill-transfer" style="color:#c62828;"></i><h3>{{ number_format($totalWithdrawals) }}</h3><p>إجمالي المسحوبات</p></div>
        </div>

        <div class="panel">
            <h2>📅 ملخص يومي</h2>
            <table>
                <thead><tr><th>التاريخ</th><th>عدد التبرعات</th><th>المبلغ</th></tr></thead>
                <tbody>
                    @php $daily = \App\Models\Donation::where('status', 'confirmed')->selectRaw('DATE(created_at) as date, COUNT(*) as count, SUM(amount) as total')->groupBy('date')->orderBy('date', 'desc')->take(30)->get(); @endphp
                    @forelse($daily as $d)
                    <tr><td>{{ $d->date }}</td><td>{{ $d->count }} تبرع</td><td>{{ number_format($d->total) }} ش</td></tr>
                    @empty
                    <tr><td colspan="3" class="empty">لا توجد بيانات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="panel">
            <h2>📊 ملخص شهري</h2>
            <table>
                <thead><tr><th>الشهر</th><th>عدد التبرعات</th><th>المبلغ</th></tr></thead>
                <tbody>
                    @php $monthly = \App\Models\Donation::where('status', 'confirmed')->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count, SUM(amount) as total")->groupBy('month')->orderBy('month', 'desc')->take(12)->get(); @endphp
                    @forelse($monthly as $m)
                    <tr><td>{{ $m->month }}</td><td>{{ $m->count }} تبرع</td><td>{{ number_format($m->total) }} ش</td></tr>
                    @empty
                    <tr><td colspan="3" class="empty">لا توجد بيانات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
