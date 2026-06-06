<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بوابة الدخول - صندوق مساعدة الناس</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma;
            background: #f4f7f6;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(12, 57, 43, 0.08);
            width: 100%;
            max-width: 420px;
            padding: 25px;
        }

        .header-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .header-section h2 {
            color: #0c392b;
            font-size: 22px;
            margin: 0 0 8px 0;
        }

        .header-section p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
            text-align: right;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e0;
            border-radius: 8px;
            font-size: 15px;
            box-sizing: border-box;
            text-align: right;
        }

        .btn-submit {
            width: 100%;
            background: #0c392b;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>

    @php
        $isAdmin = request()->is('admin/*');
        $guard = $isAdmin ? 'admin' : 'organization';
    @endphp

    <div class="login-card">
        <div class="header-section">
            <h2>{{ $isAdmin ? 'بوابة الإداري' : 'بوابة المؤسسة' }}</h2>
            <p>صندوق مساعدة الناس - بيت حانون</p>
        </div>


        @if (session('status_message'))
            <div
                style="background: #ffc107; color: #0c392b; text-align: center; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                {{ session('status_message') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif
        <form action="/{{ $guard }}/login" method="POST">
            @csrf

            @if ($isAdmin)
                <div class="form-group">
                    <label>رقم الهوية الوطنية</label>
                    <input type="text" class="form-control" name="national_id" placeholder="أدخل 9 أرقام"
                        maxlength="9" required>
                </div>
            @else
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" placeholder="example@email.com" required>
                </div>
            @endif

            <div class="form-group">
                <label>رقم الجوال</label>
                <input type="text" class="form-control" name="phone" placeholder="059xxxxxxx" required>
            </div>

            <input type="hidden" name="guard" value="{{ $guard }}">

            <button type="submit" class="btn-submit">
                {{ $isAdmin ? 'تأكيد الدخول' : 'تسجيل الدخول' }} </button>
        </form>

        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ url('/') }}" style="color: #718096; font-size: 13px; text-decoration: none;">← رجوع</a>
        </div>
    </div>

</body>

</html>
