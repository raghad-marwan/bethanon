<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>كل الإشعارات - لوحة التحكم</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .btn { background: #0c392b; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>🔔 كل الإشعارات</h2>
        <a href="/admin/dashboard">← العودة</a>
    </div>
    <div class="container">
        <div class="panel">
            <button onclick="openModal('notificationModal')" class="btn" style="margin-bottom:15px;">+ إضافة إشعار</button>
            <table>
                <thead><tr><th>العنوان</th><th>النص</th><th>التاريخ</th><th>حذف</th></tr></thead>
                <tbody>
                    @forelse(\App\Models\Notification::latest()->get() as $notif)
                    <tr>
                        <td>{{ $notif->title }}</td>
                        <td>{{ $notif->message }}</td>
                        <td>{{ $notif->created_at->format('Y/m/d') }}</td>
                        <td>
                            <form action="/admin/notifications/{{ $notif->id }}" method="POST" onsubmit="return confirm('حذف؟')">@csrf @method('DELETE')<button style="background:none;border:none;color:#c62828;cursor:pointer;">🗑️</button></form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="empty">لا توجد إشعارات</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-overlay" id="notificationModal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.5);z-index:200;justify-content:center;align-items:center;"><div style="background:white;border-radius:16px;padding:25px;max-width:500px;width:90%;"><h3>🔔 إضافة إشعار</h3><form action="/admin/notifications" method="POST">@csrf<input type="text" name="title" placeholder="عنوان الإشعار" required style="width:100%;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:12px;"><textarea name="message" rows="3" placeholder="نص الإشعار" required style="width:100%;padding:12px;border:1px solid #e2e8f0;border-radius:8px;margin-bottom:12px;"></textarea><button type="submit" style="width:100%;padding:12px;background:#0c392b;color:white;border:none;border-radius:8px;cursor:pointer;">إضافة</button></form><button onclick="closeModal('notificationModal')" style="background:#666;margin-top:10px;width:100%;padding:12px;color:white;border:none;border-radius:8px;cursor:pointer;">إلغاء</button></div></div>
    <script>
        function openModal(id) { document.getElementById(id).style.display = 'flex'; }
        function closeModal(id) { document.getElementById(id).style.display = 'none'; }
    </script>
</body>
</html>
