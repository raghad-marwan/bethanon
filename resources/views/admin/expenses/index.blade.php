<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المصروفات - لوحة التحكم</title>
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
    </style>
</head>
<body>
    <div class="topbar">
        <h2>💸 المصروفات</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <h2>إضافة مصروف جديد</h2>
            <form action="/admin/expenses" method="POST">
                @csrf
                <select name="project_id" required>
                    <option value="">اختر المشروع</option>
                    @foreach($projects as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="description" placeholder="وصف المصروف" required>
                <input type="number" name="amount" placeholder="المبلغ (شيكل)" required>
                <input type="date" name="expense_date" value="{{ now()->format('Y-m-d') }}">
                <button type="submit">إضافة</button>
            </form>
        </div>

        <div class="panel">
            <h2>قائمة المصروفات</h2>
            <table>
                <thead><tr><th>المشروع</th><th>الوصف</th><th>المبلغ</th><th>التاريخ</th></tr></thead>
                <tbody>
                    @forelse($expenses as $e)
                    <tr>
                        <td>{{ $e->project->name ?? '-' }}</td>
                        <td>{{ $e->description }}</td>
                        <td>{{ number_format($e->amount) }} ش</td>
                        <td>{{ $e->expense_date }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4">لا توجد مصروفات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
