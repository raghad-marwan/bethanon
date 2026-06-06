<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة مناشدة - صندوق مساعدة الناس</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma;
            background: #f1f5f9;
            padding: 40px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        h2 {
            color: #0c392b;
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
            font-size: 14px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 15px;
            font-family: inherit;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #0c392b;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .checkbox-group input {
            width: auto;
            margin: 0;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>📢 إضافة مناشدة جديدة</h2>
        <form action="/admin/appeals" method="POST">
            @csrf
            <label>عنوان المناشدة</label>
            <input type="text" name="title" placeholder="أدخل عنوان المناشدة" required>

            <label>وصف المناشدة</label>

            <textarea name="description" rows="4" placeholder="أدخل وصف المناشدة" required></textarea>

            <label>المبلغ المستهدف (شيكل)</label>
            <input type="number" name="target_amount" placeholder="أدخل المبلغ المستهدف" required min="1"
                style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 10px; font-size: 16px;">
            <label>المبلغ الحالي (اختياري)</label>
            
            <input type="number" name="current_amount" placeholder="0" value="0">

            <div class="checkbox-group">
                <input type="checkbox" name="is_urgent" value="1" id="urgent">
                <label for="urgent" style="margin: 0;">مناشدة عاجلة</label>
            </div>

            <button type="submit">نشر المناشدة</button>
        </form>
        <a href="/admin/dashboard" class="back">← العودة للوحة التحكم</a>
    </div>
</body>

</html>
