<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head><meta charset="UTF-8"></head>
<body style="font-family: 'Segoe UI', Tahoma; text-align: right; padding: 20px;">
    <h2 style="color: #c62828;">❌ تم رفض التبرع</h2>
    <p>عزيزي {{ $donation->organization->name }}،</p>
    <p>نأسف لإعلامك بأنه تم رفض تبرعكم بقيمة <strong>{{ number_format($donation->amount) }} شيكل</strong>.</p>
    <p>يرجى مراجعة الإيصال والتأكد من صحة التحويل.</p>
    <p style="color: #666;">صندوق مساعدة الناس - بيت حانون</p>
</body>
</html>
