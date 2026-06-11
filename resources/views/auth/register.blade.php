<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>إنشاء حساب - صندوق بيت حانون التكافلي المستدام</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma; background: #f4f7f6; margin: 0; padding: 20px; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .register-card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 100%; max-width: 420px; padding: 25px; }
        .header-section { text-align: center; margin-bottom: 25px; }
        .header-section h2 { color: #0c392b; font-size: 22px; margin: 0 0 8px 0; }
        .header-section p { color: #666; font-size: 14px; margin: 0; }
        .form-group { margin-bottom: 18px; text-align: right; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 6px; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #cbd5e0; border-radius: 8px; font-size: 15px; box-sizing: border-box; text-align: right; }
        .btn-submit { width: 100%; background: #0c392b; color: white; border: none; padding: 14px; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; }
        .alert-success { background: #dcfce7; color: #166534; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; }
        .alert-error { background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 15px; text-align: center; }
        .note { background: #fef9c3; color: #854d0e; padding: 10px; border-radius: 8px; margin-top: 15px; font-size: 13px; text-align: center; }
    </style>
</head>
<body>
    <div class="register-card">
        <div class="header-section">
            <h2>إنشاء حساب مؤسسة</h2>
            <p>صندوق بيت حانون التكافلي المستدام</p>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form id="registerForm">
            <div class="form-group">
                <label>اسم المؤسسة</label>
                <input type="text" class="form-control" id="name" placeholder="أدخل اسم المؤسسة" required>
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="email" class="form-control" id="email" placeholder="example@email.com" required>
            </div>

            <div class="form-group">
                <label>رقم الجوال</label>
                <input type="text" class="form-control" id="phone" placeholder="059xxxxxxx" required>
            </div>

            <button type="submit" class="btn-submit" id="submitBtn">إنشاء حساب</button>
        </form>

        <div class="note">
            ⚠️ سيتم مراجعة طلبك من قبل الإدارة قبل تفعيل الحساب
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ url('/') }}" style="color: #718096; font-size: 13px; text-decoration: none;">← رجوع</a>
        </div>
    </div>

    <script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;

        if (!name || !email || !phone) {
            alert('يرجى تعبئة جميع الحقول');
            return;
        }

        try {
            const response = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ guard: 'organization', name, email, phone })
            });

            const data = await response.json();
            alert(data.message);

            if (data.redirect) {
                window.location.href = data.redirect;
            }
        } catch (error) {
            alert('حدث خطأ في الاتصال');
        }
    });
    </script>
</body>
</html>
