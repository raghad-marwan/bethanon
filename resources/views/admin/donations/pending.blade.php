<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تبرعات قيد المراجعة - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 1100px; margin: 25px auto; padding: 0 20px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .panel h2 { color: #0c392b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; }
        .action-btn { padding: 4px 10px; border-radius: 6px; text-decoration: none; font-size: 11px; margin: 0 2px; }
        .btn-confirm { background: #dcfce7; color: #166534; }
        .btn-reject { background: #fee2e2; color: #991b1b; }
        .btn-view { background: #dbeafe; color: #1e40af; }
        .empty { text-align: center; padding: 30px; color: #999; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>⏳ تبرعات قيد المراجعة</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <table>
                <thead><tr><th>المتبرع</th><th>المبلغ</th><th>الطريقة</th><th>المؤسسة</th><th>الإيصال</th><th>التاريخ</th><th>إجراء</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Donation::where('status', 'pending')->latest()->get() as $d)
                    <tr>
                        <td>{{ $d->anonymous ? 'فاعل خير' : $d->donor_name }}</td>
                        <td>{{ $d->amount }} ش</td>
                        <td>{{ $d->payment_method == 'usdt' ? 'USDT' : 'محفظة' }}</td>
                        <td>{{ $d->organization->name ?? '-' }}</td>
                        <td>@if($d->receipt)<a href="{{ asset('storage/'.$d->receipt) }}" target="_blank" class="btn-view action-btn">عرض</a>@else - @endif</td>
                        <td>{{ $d->created_at->format('Y/m/d') }}</td>
                        <td><a href="/admin/donations/{{ $d->id }}/confirm" class="btn-confirm action-btn">✅</a><a href="/admin/donations/{{ $d->id }}/reject" class="btn-reject action-btn">❌</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="empty">لا توجد تبرعات معلقة</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
