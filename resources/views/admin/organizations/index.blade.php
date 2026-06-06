<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبات المؤسسات - لوحة التحكم</title>
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
        .badge-pending { background: #fef9c3; color: #854d0e; }
        .badge-approved { background: #dcfce7; color: #166534; }
        .badge-rejected { background: #fee2e2; color: #991b1b; }
        .action-btn { padding: 4px 10px; border-radius: 6px; text-decoration: none; font-size: 11px; margin: 0 2px; }
        .btn-confirm { background: #dcfce7; color: #166534; }
        .btn-reject { background: #fee2e2; color: #991b1b; }
        .empty { text-align: center; padding: 30px; color: #999; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>🏢 طلبات المؤسسات</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <h3 style="margin-bottom:15px;">⏳ طلبات جديدة</h3>
            <table>
                <thead><tr><th>المؤسسة</th><th>الإيميل</th><th>الجوال</th><th>التاريخ</th><th>إجراء</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Organization::where('status', 'pending')->latest()->get() as $org)
                    <tr>
                        <td>{{ $org->name }}</td>
                        <td>{{ $org->email }}</td>
                        <td>{{ $org->phone }}</td>
                        <td>{{ $org->created_at->format('Y/m/d') }}</td>
                        <td>
                            <a href="/admin/organizations/{{ $org->id }}/approve" class="btn-confirm action-btn">✅ موافقة</a>
                            <a href="/admin/organizations/{{ $org->id }}/reject" class="btn-reject action-btn">❌ رفض</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="empty">لا توجد طلبات جديدة</td></tr>
                    @endforelse
                </tbody>
            </table>

            <h3 style="margin-top:30px;margin-bottom:15px;">✅ المؤسسات المعتمدة</h3>
            <table>
                <thead><tr><th>المؤسسة</th><th>الإيميل</th><th>الجوال</th><th>تاريخ القبول</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Organization::where('status', 'approved')->latest()->get() as $org)
                    <tr>
                        <td>{{ $org->name }}</td>
                        <td>{{ $org->email }}</td>
                        <td>{{ $org->phone }}</td>
                        <td>{{ $org->updated_at->format('Y/m/d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="empty">لا توجد مؤسسات معتمدة</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
