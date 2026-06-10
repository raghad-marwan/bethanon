<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المشاريع - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 900px; margin: 25px auto; padding: 0 20px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); margin-bottom: 20px; }
        .panel h2 { color: #0c392b; margin-bottom: 15px; }
        input, textarea, select { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 10px; font-family: inherit; }
        button { background: #0c392b; color: white; border: none; padding: 12px 20px; border-radius: 8px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; }
        .badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; }
        .badge-planned { background: #fef9c3; color: #854d0e; }
        .badge-progress { background: #dbeafe; color: #1e40af; }
        .badge-completed { background: #dcfce7; color: #166534; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>🏗️ المشاريع</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <h2>إضافة مشروع جديد</h2>
            <form action="/admin/projects" method="POST">
                @csrf
                <input type="text" name="name" placeholder="اسم المشروع" required>
                <textarea name="description" rows="3" placeholder="وصف المشروع"></textarea>
                <input type="number" name="budget" placeholder="الميزانية (شيكل)" required>
                <select name="status">
                    <option value="planned">مخطط</option>
                    <option value="in_progress">قيد التنفيذ</option>
                    <option value="completed">مكتمل</option>
                </select>
                <button type="submit">إضافة</button>
            </form>
        </div>

        <div class="panel">
            <h2>قائمة المشاريع</h2>
            <table>
                <thead><tr><th>المشروع</th><th>الميزانية</th><th>الحالة</th><th>إكمال</th><th>حذف</th></tr></thead>
                <tbody>
                    @forelse($projects as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ number_format($p->budget) }} ش</td>
                        <td>
                            @if($p->status == 'planned') <span class="badge badge-planned">مخطط</span>
                            @elseif($p->status == 'in_progress') <span class="badge badge-progress">قيد التنفيذ</span>
                            @else <span class="badge badge-completed">مكتمل</span> @endif
                        </td>
                        <td>
                            @if($p->status != 'completed')
                            <a href="/admin/projects/{{ $p->id }}/complete" style="color:#166534;">✅ إكمال</a>
                            @endif
                        </td>
                        <td>
                            <form action="/admin/projects/{{ $p->id }}" method="POST" onsubmit="return confirm('حذف المشروع؟')">
                                @csrf @method('DELETE')
                                <button style="background:none;border:none;color:#c62828;cursor:pointer;">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">لا توجد مشاريع</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
