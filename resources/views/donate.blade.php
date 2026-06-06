<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تبرع الآن - صندوق مساعدة الناس</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma;
            background: linear-gradient(135deg, #0c392b 0%, #165240 50%, #1a5c3a 100%);
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 15px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header a {
            color: #a0c4b8;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .header a:hover {
            color: white;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .hero {
            text-align: center;
            margin-bottom: 25px;
            color: white;
        }

        .hero i {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .hero h2 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .hero p {
            color: #a0c4b8;
            font-size: 14px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #0c392b;
            margin: 25px 0 12px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i {
            color: #0c392b;
            font-size: 18px;
        }

        .payment-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .payment-option {
            border: 2px solid #e2e8f0;
            padding: 15px;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            position: relative;
        }

        .payment-option:hover {
            border-color: #0c392b;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .payment-option.selected {
            border-color: #0c392b;
            background: #f0fdf4;
        }

        .payment-option input[type="radio"] {
            position: absolute;
            top: 10px;
            right: 10px;
            accent-color: #0c392b;
            width: 16px;
            height: 16px;
        }

        .payment-option i {
            font-size: 28px;
            color: #0c392b;
            margin-bottom: 8px;
            display: block;
        }

        .payment-option .title {
            font-weight: 700;
            color: #0c392b;
            font-size: 14px;
        }

        .payment-option .desc {
            font-size: 11px;
            color: #666;
            margin-top: 4px;
        }

        .info-box {
            background: #f0fdf4;
            border: 1px solid #86efac;
            padding: 18px;
            border-radius: 12px;
            margin-top: 12px;
            display: none;
        }

        .info-box.active {
            display: block;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .info-box .label {
            font-weight: 700;
            color: #166534;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .info-box .copy-row {
            display: flex;
            gap: 8px;
        }

        .info-box .copy-row input {
            flex: 1;
            padding: 12px;
            border: 1px solid #86efac;
            border-radius: 10px;
            font-size: 14px;
            text-align: center;
            direction: ltr;
            background: white;
            color: #0c392b;
            font-weight: 600;
        }

        .info-box .copy-row button {
            background: #0c392b;
            color: white;
            border: none;
            padding: 12px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            transition: 0.3s;
        }

        .info-box .copy-row button:hover {
            background: #165240;
        }

        .info-box .details {
            margin-top: 10px;
            font-size: 12px;
            color: #166534;
            line-height: 1.8;
        }

        .info-box .note {
            background: #fef9c3;
            color: #854d0e;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 12px;
        }

        .form-group {
            margin: 18px 0;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 14px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: 0.3s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #0c392b;
            box-shadow: 0 0 0 3px rgba(12, 57, 43, 0.1);
        }

        .form-group select {
            appearance: auto;
            cursor: pointer;
        }

        .radio-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .radio-group label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: normal;
            font-size: 14px;
        }

        .radio-group label:has(input:checked) {
            border-color: #0c392b;
            background: #f0fdf4;
        }

        .radio-group input[type="radio"] {
            accent-color: #0c392b;
            width: 16px;
            height: 16px;
        }

        .file-upload {
            border: 2px dashed #e2e8f0;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: 0.3s;
        }

        .file-upload:hover {
            border-color: #0c392b;
            background: #f8fafc;
        }

        .file-upload i {
            font-size: 32px;
            color: #0c392b;
            margin-bottom: 8px;
        }

        .file-upload p {
            color: #666;
            font-size: 13px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: #0c392b;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 18px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 25px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #165240;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(12, 57, 43, 0.3);
        }

        .btn-back {
            display: block;
            text-align: center;
            color: white;
            text-decoration: none;
            margin-top: 20px;
            font-size: 14px;
            opacity: 0.8;
            transition: 0.3s;
        }

        .btn-back:hover {
            opacity: 1;
        }

        .alert {
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        @media (max-width: 500px) {
            .payment-options {
                grid-template-columns: 1fr;
            }

            .container {
                padding: 15px;
            }

            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <a href="{{ url('/') }}"><i class="fa-solid fa-arrow-right"></i> العودة للصفحة الرئيسية</a>
    </div>

    <div class="container">
        <div class="hero">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <h2>تبرع الآن</h2>
            <p>اختر طريقة الدفع المناسبة لك</p>
        </div>

        <div class="card">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('donation.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- طريقة الدفع --}}
                <div class="section-title"><i class="fa-solid fa-credit-card"></i> اختر طريقة التبرع</div>

                <div class="payment-options">
                    <label class="payment-option" id="card-bank">
                        <input type="radio" name="payment_method" value="bank" required
                            onchange="toggleInfo('bank')">
                        <i class="fa-solid fa-building-columns"></i>
                        <div class="title"> محفظة</div>
                        <div class="desc">تحويل مباشر </div>
                    </label>

                    <label class="payment-option" id="card-usdt">
                        <input type="radio" name="payment_method" value="usdt" onchange="toggleInfo('usdt')">
                        <i class="fa-brands fa-bitcoin"></i>
                        <div class="title">USDT</div>
                        <div class="desc">عملة رقمية TRC20</div>
                    </label>
                </div>

                {{-- معلومات البنك --}}
                <div class="info-box" id="info-bank">
                    <div class="label">📋 رقم المحفظة للتحويل</div>
                    <div class="copy-row">
                        <input type="text" id="ibanInput" value="{{ $paymentMethods['bank']['iban'] }}" readonly>
                        <button type="button" onclick="copyIban()"><i class="fa-solid fa-copy"></i> نسخ</button>
                    </div>
                    <div class="details">
                        <p><strong>📱 المحفظة:</strong> {{ $paymentMethods['bank']['bank_name'] }}</p>
                        <p><strong>👤 المستفيد:</strong> {{ $paymentMethods['bank']['account_name'] }}</p>
                    </div>
                </div>

                {{-- معلومات USDT --}}
                <div class="info-box" id="info-usdt">
                    <div class="label">💎 عنوان محفظة USDT</div>
                    <div class="copy-row">
                        <input type="text" value="{{ $paymentMethods['usdt']['address'] }}" readonly>
                        <button type="button" onclick="copyUsdt()"><i class="fa-solid fa-copy"></i> نسخ</button>
                    </div>
                    <div class="note">⚠️ الشبكة: {{ $paymentMethods['usdt']['network'] }} - تأكد من الشبكة قبل الإرسال
                    </div>
                </div>

                {{-- المبلغ --}}
                <div class="section-title"><i class="fa-solid fa-money-bill-wave"></i> المبلغ</div>
                <div class="form-group">
                    <input type="number" name="amount" step="0" placeholder="أدخل المبلغ بالشيكل" required>
                </div>

                {{-- هدف التبرع --}}
                <div class="section-title"><i class="fa-solid fa-bullseye"></i> هدف التبرع</div>
                <div class="form-group">
                    <select name="donation_goal" required>
                        <option value="">اختر الهدف</option>
                        @foreach ($goals as $key => $name)
                            <option value="{{ $key }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- الظهور --}}
                <div class="section-title"><i class="fa-solid fa-user"></i> تريد ظهور اسمك؟</div>
                <div class="form-group">
                    <div class="radio-group">
                        <label>
                            <input type="radio" name="donor_visibility" value="public" required
                                onchange="toggleName()">
                            نعم، أظهر اسمي
                        </label>
                        <label>
                            <input type="radio" name="donor_visibility" value="anonymous" onchange="toggleName()">
                            لا، فاعل خير
                        </label>
                    </div>
                    <input type="text" name="donor_name" id="donor_name" placeholder="اكتب اسمك الكريم"
                        style="display:none; margin-top:12px;">
                </div>

                {{-- رفع الإيصال --}}
                <div class="section-title"><i class="fa-solid fa-camera"></i> إثبات التحويل</div>
                <div class="form-group">
                    <input type="file" name="receipt" accept="image/*" required>
                </div>

                {{-- إرسال --}}
                @if (request('appeal_id'))
                    <input type="hidden" name="appeal_id" value="{{ request('appeal_id') }}">
                @endif
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-paper-plane"></i> إرسال التبرع
                </button>
            </form>
        </div>

        <a href="{{ url('/') }}" class="btn-back"><i class="fa-solid fa-arrow-right"></i> العودة للصفحة
            الرئيسية</a>
    </div>

    <script>
        function toggleInfo(type) {
            document.querySelectorAll('.info-box').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.payment-option').forEach(c => c.classList.remove('selected'));

            if (type === 'bank') {
                document.getElementById('info-bank').classList.add('active');
                document.getElementById('card-bank').classList.add('selected');
            } else if (type === 'usdt') {
                document.getElementById('info-usdt').classList.add('active');
                document.getElementById('card-usdt').classList.add('selected');
            }
        }

        function toggleName() {
            const vis = document.querySelector('input[name="donor_visibility"]:checked')?.value;
            document.getElementById('donor_name').style.display = vis === 'public' ? 'block' : 'none';
        }

        function copyIban() {
            const input = document.getElementById('ibanInput');
            input.select();
            document.execCommand('copy');
            alert('✅ تم نسخ الآيبان');
        }

        function copyUsdt() {
            const input = document.querySelector('#info-usdt input');
            input.select();
            document.execCommand('copy');
            alert('✅ تم نسخ عنوان USDT');
        }
    </script>

</body>

</html>
