<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> صندوق بيت حانون التكافلي المستدام</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <i class="fa-solid fa-hand-holding-heart logo-icon"></i>
                <div class="logo-text">
                    <span class="main-title">صندوق مساعدة الناس</span>
                    <span class="sub-title">بيت حانون</span>
                    <span class="sub-title"> المهندس: صهيب البسيوني</span>
                </div>
            </a>

            <ul class="nav-menu">
                <li class="nav-item"><a href="#" class="nav-link active">الرئيسية</a></li>
                <li class="nav-item"><a href="#" class="nav-link">عن بيت حانون</a></li>
                <li class="nav-item"><a href="#" class="nav-link">المشاريع</a></li>
                <li class="nav-item"><a href="#" class="nav-link">المستفيدين</a></li>
                <li class="nav-item"><a href="#" class="nav-link">التبرعات</a></li>
                <li class="nav-item"><a href="#" class="nav-link">تواصل معنا</a></li>
            </ul>

            <div class="nav-actions">
                @if (Auth::guard('admin')->check())
                    <span>👋 {{ Auth::guard('admin')->user()->name }}</span>
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-login-n">لوحة التحكم</a>
                    <form action="/logout" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit"
                            style="background: #c62828; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;">تسجيل
                            خروج</button>
                    </form>
                @elseif(Auth::guard('organization')->check())
                    <span>👋 {{ Auth::guard('organization')->user()->name }}</span>
                    <form action="/logout" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit"
                            style="background: #c62828; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer;">تسجيل
                            خروج</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="btn btn-register">إنشاء حساب</a>
                @endif
            </div>

            <button class="hamburger" id="hamburger-btn" aria-label="قائمة التنقل">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>
    </nav>

    @if (session('status_message'))
        <div style="background: #ffc107; color: #0c392b; text-align: center; padding: 12px; font-size: 16px;">
            {{ session('status_message') }}
        </div>
    @endif

    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title"> صندوق بيت حانون التكافلي <br><span>المستدام </span></h1>
                <p class="hero-description">
                    من أهلنا... لأهلنا، نطلق هذا الصندوق لنكون سنداً حقيقياً لكل محتاج في بيت حانون. معاً نخفف الألم،
                    ونصنع الأمل، ونبني مستقبلاً أفضل.
                </p>
                <div class="features-wrapper">
                    <div class="feature-card hidden-card">
                        <div class="card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <h3 class="card-title">يداً بيد</h3>
                        <p class="card-text">نحو مجتمع متكافل</p>
                    </div>
                    <div class="feature-card hidden-card">
                        <div class="card-icon"><i class="fa-solid fa-users-gear"></i></div>
                        <h3 class="card-title">لجنة محلية موثوقة</h3>
                        <p class="card-text">من أهل بيت حانون</p>
                    </div>
                    <div class="feature-card hidden-card">
                        <div class="card-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h3 class="card-title">شفافية تامة</h3>
                        <p class="card-text">كل تبرع يصل لمستحقيه</p>
                    </div>
                </div>
            </div>
            <div class="hero-image-container">
                <img src="{{ asset('assets/images/bet.jpeg') }}" alt="لأننا أهل ويد واحدة" class="hero-img">
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <div class="image-side">
                <div class="image-wrapper">
                    <img src="{{ asset('assets/images/img2.jpg') }}" alt="مدينة بيت حانون">
                </div>
            </div>
            <div class="content-side">
                <h2 class="section-title">عن بيت حانون</h2>
                <p class="section-desc">
                    بيت حانون مدينة فلسطينية تقع شمال قطاع غزة، تُعرف بتاريخها العريق وأصالة أهلها وتكاتفهم. رغم
                    التحديات، يبقى أهلها أوفياء لقيمهم متحابين متعاونين، يمدون يد العون لكل محتاج.
                </p>
                <div class="stats-container">
                    <div class="stat-card">
                        <span class="stat-label">مساحة المدينة</span>
                        <div class="stat-number-wrapper">
                            <span class="stat-unit" style="margin-right: 5px;">كم²</span>
                            <span class="stat-number" data-target="13">0</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">عدد السكان</span>
                        <div class="stat-number-wrapper">
                            <span class="stat-number" data-target="75000">0</span>
                            <span class="stat-plus">+</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <span class="stat-label">مستفيد سنوياً</span>
                        <div class="stat-number-wrapper">
                            <span class="stat-number" data-target="10000">0</span>
                            <span class="stat-plus">+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="donation-dashboard">
        <div class="dashboard-container" style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <div class="dashboard-card card-stats" style="flex: 1; max-width: 400px;">
                <div class="stat-box">
                    <h3 class="card-title-d">إجمالي المصروفات للمشاريع التشغيلية</h3>
                    <div class="main-number">
                        <span class="counter" data-target="{{ $stats['total'] }}">0</span> <span
                            class="currency">شيكل</span>
                    </div>
                </div>
                <div class="monthly-stat-box">
                    <h4 class="sub-title-d">إجمالي المصروفات للمشاريع هذا الشهر</h4>
                    <div class="secondary-number">
                        <span class="counter" data-target="{{ $stats['this_month'] }}">0</span> <span>شيكل</span>
                    </div>
                </div>
                <button class="btn btn-outline">طلب المزيد من التفاصيل</button>
            </div>

            <div class="dashboard-card card-main-action" style="flex: 1; max-width: 400px; text-align: center;">
                <div class="stat-box">
                    <h3 class="card-title-d">إجمالي عدد المشاريع التي تم تنفيذها من قبل الصندوق</h3>
                    <div class="main-number highlight" style="margin-top: 20px;">
                        <span class="counter" data-target="{{ $stats['today'] }}">0</span>
                    </div>
                </div>
                <a href="{{ route('donate') }}" class="btn btn-primary" style="margin-top: 20px;">تبرع الآن</a>
            </div>
        </div>
    </section>

    <section class="join-us-section">
        <div class="container">
            <div class="citizen-options-card">
                <h3 class="section-title">كمواطن يمكنك</h3>
                <div class="options-wrapper">
                    <div class="option-row" data-action="donate">
                        <div class="option-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <div class="option-info">
                            <h4>التبرع</h4>
                            <p>ساهم بما تجود به نفسك ودعم أهل بيت حانون</p>
                        </div>
                    </div>
                    <div class="option-row" data-action="help">
                        <div class="option-icon"><i class="fa-solid fa-hands-holding"></i></div>
                        <div class="option-info">
                            <h4>طلب مساعدة</h4>
                            <p>تقدم بطلب مساعدة إذا كنت بحاجة للدعم</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="account-types-card">
                <div class="center-header">
                    <h3 class="section-title">انضم إلينا</h3>
                    <p class="section-subtitle">اختر نوع حسابك للبدء</p>
                </div>
                <div class="types-grid">
                    <div class="type-box">
                        <div class="box-icon"><i class="fa-solid fa-users-gear"></i></div>
                        <h4>لجنة / إداري</h4>
                        <p>للإطلاع على البيانات وإدارة المستفيدين</p>
                        <a href="{{ route('admin.login') }}" class="btn-login">تسجيل دخول</a>
                    </div>
                    <div class="type-box highlighted">
                        <div class="box-icon"><i class="fa-solid fa-user"></i></div>
                        <h4>مواطن</h4>
                        <p>يمكنك التبرع أو طلب مساعدة حسب احتياجك</p>
                        <a href="https://ahalibeithanoun.com/" class="btn-login">تسجيل دخول</a>
                    </div>
                    <div class="type-box">
                        <div class="box-icon"><i class="fa-solid fa-building-ngo"></i></div>
                        <h4>مؤسسة / مبادرة</h4>
                        <p>لدعم المشاريع والمبادرات والاطلاع على التقارير</p>
                        <a href="{{ route('organization.login') }}" class="btn-login">تسجيل دخول</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="info-section">
        <div class="container">
            <div class="info-card contact-card">
                <div class="card-leaves-top"></div>
                <h3 class="card-title">تواصل مع اللجنة</h3>
                <p class="card-subtitle">لأي استفسار أو مقترح أو مشكلة نحن هنا لخدمتكم</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <span class="item-text" dir="ltr">+972 59 123 4567</span>
                        <i class="fa-solid fa-phone icon-box"></i>
                    </div>
                    <div class="contact-item">
                        <a href="mailto:Takafulbeithanoun@gmail.com" style="text-decoration: none;">
                            <span class="item-text">Takafulbeithanoun@gmail.com</span>
                        </a>
                        <i class="fa-solid fa-envelope icon-box"></i>
                    </div>
                    <div class="contact-item">
                        <span class="item-text">بيت حانون - قطاع غزة</span>
                        <i class="fa-solid fa-location-dot icon-box"></i>
                    </div>
                    <div class="contact-item">
                        <span class="item-text">السبت - الخميس: 8 ص - 6 م</span>
                        <i class="fa-solid fa-clock icon-box"></i>
                    </div>
                </div>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-telegram"></i></a>
                    <a href="https://www.facebook.com/share/1DmvMj32od/?mibextid=wwXIfr" class="social-icon"><i
                            class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>

            @if (isset($urgentAppeals) && $urgentAppeals->count() > 0)
                @foreach ($urgentAppeals as $appeal)
                    <div class="info-card appeal-card">
                        <h3 class="card-title">اليوم في مناشدة</h3>
                        @if ($appeal->is_urgent)
                            <span class="badge-urgent">مناشدة عاجلة</span>
                        @endif
                        <h4 class="appeal-heading">{{ $appeal->title }}</h4>
                        <p class="appeal-desc">{{ $appeal->description }}</p>
                        <div class="progress-container">
                            <div class="progress-text">
                                @php $percent = $appeal->target_amount > 0 ? ($appeal->current_amount / $appeal->target_amount) * 100 : 0; @endphp
                                <span>تم جمع <strong>{{ number_format($appeal->current_amount) }}</strong> من أصل
                                    {{ number_format($appeal->target_amount) }} شيكل</span>
                            </div>
                            <div class="progress-bar2">
                                <div class="progress-fill" style="width: {{ $percent }}%;"></div>
                            </div>
                        </div>
                        <a href="{{ route('donate', ['appeal_id' => $appeal->id]) }}" class="btn-donate">ساهم
                            الآن</a>
                    </div>
                @endforeach
            @endif

            <div class="info-card notifications-card">
                <div class="card-leaves-bottom"></div>
                <h3 class="card-title">آخر الإشعارات</h3>
                <div class="notifications-list">
                    @foreach ($notifications as $notification)
                        <div class="notification-item">
                            <span class="noti-time">{{ $notification->created_at->diffForHumans() }}</span>
                            <div class="noti-content">
                                <h5>{{ $notification->title }}</h5>
                                <p>{{ $notification->message }}</p>
                            </div>
                            <i class="fa-solid fa-bell bell-icon"></i>
                        </div>
                    @endforeach
                </div>
                <button class="btn-view-all">عرض كل الإشعارات</button>
            </div>
        </div>
    </section>

    <footer class="main-footer">
        <div class="footer-container">
            <p class="footer-text">صندوق مساعدة الناس - بيت حانون</p>
            <p class="footer-copyright">جميع الحقوق محفوظة © 2024</p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
