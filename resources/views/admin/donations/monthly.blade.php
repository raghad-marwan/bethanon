<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تبرعات الشهر - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 1100px; margin: 25px auto; padding: 0 20px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .panel h2 { color: #0c392b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; font-weight: 600; }
        tr:hover { background: #f8fafc; }
        .empty { text-align: center; padding: 30px; color: #999; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>🗓️ تبرعات الشهر ({{ \Carbon\Carbon::now()->format('Y/m') }})</h2>
        <a href="/admin/dashboard">← العودة للوحة التحكم</a>
    </div>
    <div class="container">
        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المتبرع</th>
                        <th>المبلغ</th>
                        <th>الطريقة</th>
                        <th>الهدف</th>
                        <th>المناشدة</th>
                        <th>التاريخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($donations as $d)
                    <tr>
                        <td>{{ $d->id }}</td>
                        <td>{{ $d->anonymous ? 'فاعل خير' : $d->donor_name }}</td>
                        <td>{{ number_format($d->amount) }} ش</td>
                        <td>{{ $d->payment_method == 'usdt' ? 'USDT' : ($d->payment_method == 'bank' ? 'محفظة' : '-') }}</td>
                        <td>{{ $d->purpose ?? '-' }}</td>
                        <td>{{ $d->appeal->title ?? '-' }}</td>
                        <td>{{ $d->created_at->format('Y/m/d H:i') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="empty">لا توجد تبرعات هذا الشهر</td></tr>
                    @endforelse
                </tbody>
            </table>

            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 5px; flex-wrap: wrap; direction: ltr;">
                @if ($donations->onFirstPage())
                    <span style="padding: 8px 14px; border-radius: 6px; color: #999; border: 1px solid #e2e8f0;">السابق</span>
                @else
                    <a href="{{ $donations->previousPageUrl() }}" style="padding: 8px 14px; border-radius: 6px; text-decoration: none; color: #0c392b; border: 1px solid #0c392b;">السابق</a>
                @endif

                @foreach ($donations->links()->elements[0] as $page => $url)
                    @if ($page == $donations->currentPage())
                        <span style="padding: 8px 14px; border-radius: 6px; background: #0c392b; color: white;">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="padding: 8px 14px; border-radius: 6px; text-decoration: none; color: #0c392b; border: 1px solid #e2e8f0;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($donations->hasMorePages())
                    <a href="{{ $donations->nextPageUrl() }}" style="padding: 8px 14px; border-radius: 6px; text-decoration: none; color: #0c392b; border: 1px solid #0c392b;">التالي</a>
                @else
                    <span style="padding: 8px 14px; border-radius: 6px; color: #999; border: 1px solid #e2e8f0;">التالي</span>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
