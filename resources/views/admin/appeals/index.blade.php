<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كل المناشدات - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 1000px; margin: 25px auto; padding: 0 20px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .panel h2 { color: #0c392b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; }
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; }
        .badge-urgent { background: #fee2e2; color: #991b1b; }
        .badge-done { background: #dcfce7; color: #166534; }
        .empty { text-align: center; padding: 30px; color: #999; }
        .btn { background: #0c392b; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>📢 كل المناشدات</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <a href="/admin/appeals/create" class="btn" style="margin-bottom: 15px;">+ إضافة مناشدة</a>
            <table>
                <thead><tr><th>المناشدة</th><th>الهدف</th><th>تم جمعه</th><th>النسبة</th><th>الحالة</th><th>حذف</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Appeal::latest()->get() as $appeal)
                    <tr>
                        <td>{{ $appeal->title }}</td>
                        <td>{{ number_format($appeal->target_amount) }} ش</td>
                        <td>{{ number_format($appeal->current_amount) }} ش</td>
                        <td>{{ $appeal->target_amount > 0 ? round(($appeal->current_amount/$appeal->target_amount)*100) : 0 }}%</td>
                        <td>
                            @if($appeal->current_amount >= $appeal->target_amount) <span class="badge badge-done">✅ مكتملة</span>
                            @elseif($appeal->is_urgent) <span class="badge badge-urgent">عاجل</span>
                            @else نشطة
                            @endif
                        </td>
                        <td>
                            <form action="/admin/appeals/{{ $appeal->id }}" method="POST" onsubmit="return confirm('حذف؟')">@csrf @method('DELETE')<button style="background:none;border:none;color:#c62828;cursor:pointer;">🗑️</button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="empty">لا توجد مناشدات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
