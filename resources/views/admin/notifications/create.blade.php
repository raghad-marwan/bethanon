<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة إشعار جديد</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma; background: #f4f7f6; padding: 20px; }
        .container { max-width: 500px; margin: 50px auto; background: white; padding: 25px; border-radius: 12px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 8px; }
        button { background: #0c392b; color: white; border: none; padding: 12px 24px; border-radius: 8px; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2>إضافة إشعار جديد</h2>
        <form method="POST" action="/admin/notifications">
            @csrf
            <label>العنوان</label>
            <input type="text" name="title" required>

            <label>النص</label>
            <textarea name="message" rows="4" required></textarea>

            <button type="submit">نشر الإشعار</button>
        </form>
    </div>
</body>
</html>
