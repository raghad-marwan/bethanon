<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المسحوبات - لوحة التحكم</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma; background: #f1f5f9; }
        .topbar { background: #0c392b; color: white; padding: 15px 25px; display: flex; justify-content: space-between; }
        .topbar a { color: white; text-decoration: none; }
        .container { max-width: 800px; margin: 25px auto; padding: 0 20px; }
        .panel { background: white; padding: 20px; border-radius: 14px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .panel h2 { color: #0c392b; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: right; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #475569; }
        .empty { text-align: center; padding: 30px; color: #999; }
        .btn { background: #0c392b; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; border: none; cursor: pointer; font-size: 14px; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>💸 كل المسحوبات</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <button onclick="openModal()" class="btn" style="margin-bottom:15px;">+ سحب مبلغ</button>
            <table>
                <thead><tr><th>المبلغ</th><th>السبب</th><th>ملاحظات</th><th>التاريخ</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Withdrawal::latest()->get() as $w)
                    <tr>
                        <td>{{ number_format($w->amount) }} ش</td>
                        <td>{{ $w->reason }}</td>
                        <td>{{ $w->note ?? '-' }}</td>
                        <td>{{ $w->created_at->format('Y/m/d') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="empty">لا توجد مسحوبات</td></tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr style="font-weight:bold;background:#f0fdf4;">
                        <td>الإجمالي</td>
                        <td colspan="3">{{ number_format(\App\Models\Withdrawal::sum('amount')) }} ش</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div id="withdrawalModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:200;justify-content:center;align-items:center;">
        <div style="background:white;border-radius:16px;padding:25px;max-width:500px;width:90%;">
            <h3>💸 سحب مبلغ</h3>
            <form action="/admin/withdrawals" method="POST">@csrf
                <input type="number" name="amount" placeholder="المبلغ المسحوب (شيكل)" required style="width:100%;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:12px;">
                <input type="text" name="reason" placeholder="سبب السحب" required style="width:100%;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:12px;">
                <textarea name="note" rows="2" placeholder="ملاحظات (اختياري)" style="width:100%;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:12px;"></textarea>
                <button type="submit" style="width:100%;padding:12px;background:#0c392b;color:white;border:none;border-radius:8px;cursor:pointer;">تأكيد السحب</button>
            </form>
            <button onclick="closeModal()" style="background:#666;margin-top:10px;width:100%;padding:12px;color:white;border:none;border-radius:8px;cursor:pointer;">إلغاء</button>
        </div>
    </div>
    <script>
        function openModal() { document.getElementById('withdrawalModal').style.display = 'flex'; }
        function closeModal() { document.getElementById('withdrawalModal').style.display = 'none'; }
    </script>
</body>
</html>
