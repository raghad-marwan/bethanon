<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - صندوق مساعدة الناس</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma;
            background: #f1f5f9;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #0c392b;
            color: white;
            padding: 20px;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 100;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
            font-weight: 700;
        }

        .sidebar .logo i {
            font-size: 30px;
            display: block;
            margin-bottom: 8px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #a0c4b8;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: 0.3s;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #165240;
            color: white;
        }

        .sidebar a i {
            width: 20px;
            text-align: center;
        }

        .main {
            flex: 1;
            margin-right: 260px;
            padding: 25px;
        }

        .topbar {
            background: white;
            padding: 15px 25px;
            border-radius: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .topbar h1 {
            font-size: 20px;
            color: #0c392b;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            text-decoration: none;
            color: inherit;
            display: block;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-card .icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .stat-card .icon.green {
            background: #dcfce7;
            color: #166534;
        }

        .stat-card .icon.blue {
            background: #dbeafe;
            color: #1e40af;
        }

        .stat-card .icon.orange {
            background: #ffedd5;
            color: #9a3412;
        }

        .stat-card .icon.purple {
            background: #f3e8ff;
            color: #6b21a8;
        }

        .stat-card h3 {
            font-size: 26px;
            color: #0c392b;
        }

        .stat-card p {
            color: #666;
            font-size: 13px;
            margin-top: 4px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .panel {
            background: white;
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
            margin-bottom: 25px;
        }

        .panel h3 {
            font-size: 16px;
            color: #0c392b;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e2e8f0;
        }

        .panel .btn {
            display: inline-block;
            background: #0c392b;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px 12px;
            text-align: right;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 12px;
        }

        .badge-urgent {
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
        }

        .action-btn {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 11px;
            font-weight: 600;
            margin: 0 2px;
        }

        .btn-confirm {
            background: #dcfce7;
            color: #166534;
        }

        .btn-reject {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-view {
            background: #dbeafe;
            color: #1e40af;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #999;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 200;
            justify-content: center;
            align-items: center;
        }

        .modal {
            background: white;
            border-radius: 16px;
            padding: 25px;
            max-width: 500px;
            width: 90%;
        }

        .modal h3 {
            margin-bottom: 15px;
        }

        .modal input,
        .modal textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-bottom: 12px;
            font-family: inherit;
        }

        .modal button {
            width: 100%;
            padding: 12px;
            background: #0c392b;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                margin-right: 0;
            }

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo"><i class="fa-solid fa-hand-holding-heart"></i> لوحة التحكم</div>
        <a href="/admin/dashboard" class="active"><i class="fa-solid fa-gauge"></i> الرئيسية</a>
        <a href="/admin/statistics"><i class="fa-solid fa-chart-bar"></i> الإحصائيات</a>
        <a href="/admin/donations"><i class="fa-solid fa-hand-holding-heart"></i> كل التبرعات</a>
        <a href="/admin/donations/monthly"><i class="fa-solid fa-calendar-check"></i> تبرعات الشهر</a>
        <a href="/admin/donations/pending"><i class="fa-solid fa-clock"></i> قيد المراجعة</a>
        <a href="/admin/withdrawals"><i class="fa-solid fa-money-bill-transfer"></i> المسحوبات</a>
        <a href="/admin/projects"><i class="fa-solid fa-diagram-project"></i> المشاريع</a>
        <a href="/admin/expenses"><i class="fa-solid fa-money-bill-wave"></i> المصروفات</a>
        <a href="/admin/appeals"><i class="fa-solid fa-bullhorn"></i> المناشدات</a>
        <a href="/admin/notifications"><i class="fa-solid fa-bell"></i> الإشعارات</a>
        <a href="/admin/organizations"><i class="fa-solid fa-building-ngo"></i> طلبات المؤسسات</a>
        <a href="#" onclick="openModal('appealModal')"><i class="fa-solid fa-plus-circle"></i> إضافة مناشدة</a>
        <a href="#" onclick="openModal('notificationModal')"><i class="fa-solid fa-plus-circle"></i> إضافة
            إشعار</a>
        <a href="#" onclick="openModal('withdrawalModal')"><i class="fa-solid fa-plus-circle"></i> سحب مبلغ</a>
        <a href="/" target="_blank"><i class="fa-solid fa-globe"></i> زيارة الموقع</a>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit"
                style="background: none; border: none; color: #a0c4b8; cursor: pointer; font-size: 14px; padding: 12px 15px; width: 100%; text-align: right;"><i
                    class="fa-solid fa-right-from-bracket"></i> تسجيل خروج</button>
        </form>
    </aside>

    <main class="main">
        <div class="topbar">
            <h1>👋 مرحباً، {{ Auth::guard('admin')->user()->name }}</h1>
            <span style="color: #666;">{{ now()->format('Y/m/d') }}</span>
        </div>

        {{-- إحصائيات سريعة --}}
        <div class="stats">
            @php
                $totalDonations = \App\Models\Donation::where('status', 'confirmed')->sum('amount');
                $totalWithdrawals = \App\Models\Withdrawal::sum('amount');
            @endphp
            <a href="/admin/statistics" class="stat-card">
                <div class="icon green"><i class="fa-solid fa-hand-holding-heart"></i></div>
                <h3>{{ number_format($totalDonations - $totalWithdrawals) }}</h3>
                <p>الصافي (شيكل)</p>
            </a>
            <a href="/admin/donations/monthly" class="stat-card">
                <div class="icon blue"><i class="fa-solid fa-calendar-check"></i></div>
                <h3>{{ number_format(\App\Models\Donation::whereMonth('created_at', \Carbon\Carbon::now()->month)->where('status', 'confirmed')->sum('amount')) }}
                </h3>
                <p>تبرعات الشهر</p>
            </a>
            <a href="/admin/donations/pending" class="stat-card">
                <div class="icon orange"><i class="fa-solid fa-clock"></i></div>
                <h3>{{ \App\Models\Donation::where('status', 'pending')->count() }}</h3>
                <p>قيد المراجعة</p>
            </a>
            <a href="/admin/organizations" class="stat-card">
                <div class="icon purple"><i class="fa-solid fa-building-ngo"></i></div>
                <h3>{{ \App\Models\Organization::where('status', 'pending')->count() }}</h3>
                <p>طلبات المؤسسات</p>
            </a>
        </div>

        {{-- آخر التبرعات --}}
        <div class="grid-2">
            <div class="panel">
                <h3>💰 آخر التبرعات المؤكدة <a href="/admin/donations"
                        style="font-size: 12px; color: #0c392b; float: left;">عرض الكل ←</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>المتبرع</th>
                            <th>المبلغ</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Donation::where('status', 'confirmed')->latest()->take(5)->get() as $d)
                            <tr>
                                <td>
                                    @if ($d->organization_id && $d->organization)
                                        {{ $d->organization->name }}
                                    @else
                                        {{ $d->anonymous ? 'فاعل خير' : $d->donor_name }}
                                    @endif
                                </td>
                                <td>{{ $d->amount }} ش</td>
                                <td>{{ $d->created_at->format('Y/m/d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">لا توجد تبرعات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- آخر المسحوبات --}}
            <div class="panel">
                <h3>💸 آخر المسحوبات <a href="/admin/withdrawals"
                        style="font-size: 12px; color: #0c392b; float: left;">عرض الكل ←</a></h3>
                <table>
                    <thead>
                        <tr>
                            <th>المبلغ</th>
                            <th>السبب</th>
                            <th>التاريخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(\App\Models\Withdrawal::latest()->take(5)->get() as $w)
                            <tr>
                                <td>{{ number_format($w->amount) }} ش</td>
                                <td>{{ $w->reason }}</td>
                                <td>{{ $w->created_at->format('Y/m/d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="empty">لا توجد مسحوبات</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel">
            <h3>⏳ تبرعات قيد المراجعة <a href="/admin/donations/pending"
                    style="font-size: 12px; color: #0c392b; float: left;">عرض الكل ←</a></h3>
            <table>
                <thead>
                    <tr>
                        <th>المتبرع</th>
                        <th>المبلغ</th>
                        <th>الطريقة</th>
                        <th>التاريخ</th>
                        <th>إجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Donation::where('status', 'pending')->latest()->take(5)->get() as $d)
                        <tr>
                            <td>
                                @if ($d->organization_id && $d->organization)
                                    {{ $d->organization->name }}
                                @else
                                    {{ $d->anonymous ? 'فاعل خير' : $d->donor_name }}
                                @endif
                            </td>
                            <td>{{ $d->amount }} ش</td>
                            <td>{{ $d->payment_method == 'binance' ? 'بايننس' : 'مالتشات' }}</td>
                            <td>{{ $d->created_at->format('Y/m/d') }}</td>
                            <td>
                                <a href="/admin/donations/{{ $d->id }}/confirm"
                                    class="btn-confirm action-btn">✅</a>
                                <a href="/admin/donations/{{ $d->id }}/reject"
                                    class="btn-reject action-btn">❌</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">لا توجد تبرعات معلقة</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- المناشدات + الإشعارات --}}
        <div class="grid-2">
            <div class="panel">
                <h3>📢 المناشدات <a href="/admin/appeals" style="font-size: 12px; color: #0c392b; float: left;">عرض الكل
                        ←</a></h3>
                @forelse(\App\Models\Appeal::where('status', 'approved')->latest()->take(5)->get() as $appeal)
                    <div style="border-bottom: 1px solid #e2e8f0; padding: 10px 0;">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <strong>{{ $appeal->title }}</strong>
                                @if ($appeal->is_urgent)
                                    <span class="badge-urgent">عاجل</span>
                                @endif
                                @if ($appeal->current_amount >= $appeal->target_amount)
                                    <span
                                        style="background:#dcfce7;color:#166534;padding:2px 8px;border-radius:20px;font-size:11px;">✅
                                        اكتمل</span>
                                @endif
                            </div>
                            <form action="/admin/appeals/{{ $appeal->id }}" method="POST"
                                onsubmit="return confirm('حذف؟')">
                                @csrf @method('DELETE')
                                <button style="background:none;border:none;color:#c62828;cursor:pointer;">🗑️</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="empty">لا توجد مناشدات</p>
                @endforelse
            </div>

            <div class="panel">
                <h3>🔔 الإشعارات <a href="/admin/notifications"
                        style="font-size: 12px; color: #0c392b; float: left;">عرض الكل ←</a></h3>
                @forelse(\App\Models\Notification::latest()->take(5)->get() as $notif)
                    <div style="border-bottom: 1px solid #e2e8f0; padding: 10px 0;">
                        <div style="display: flex; justify-content: space-between;">
                            <div>
                                <strong>{{ $notif->title }}</strong>
                                <p style="font-size:12px;color:#666;">{{ $notif->message }}</p>
                            </div>
                            <form action="/admin/notifications/{{ $notif->id }}" method="POST"
                                onsubmit="return confirm('حذف؟')">
                                @csrf @method('DELETE')
                                <button style="background:none;border:none;color:#c62828;cursor:pointer;">🗑️</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="empty">لا توجد إشعارات</p>
                @endforelse
            </div>
        </div>
    </main>

    {{-- مودالات --}}
    <div class="modal-overlay" id="appealModal">
        <div class="modal">
            <h3>📢 إضافة مناشدة</h3>
            <form action="/admin/appeals" method="POST">@csrf<input type="text" name="title"
                    placeholder="عنوان المناشدة" required>
                <textarea name="description" rows="3" placeholder="وصف المناشدة" required></textarea><input type="number" name="target_amount" placeholder="المبلغ المستهدف"
                    required><input type="number" name="current_amount" placeholder="المبلغ الحالي"
                    value="0"><label><input type="checkbox" name="is_urgent" value="1"> مناشدة
                    عاجلة</label><button type="submit">إضافة</button>
            </form><button onclick="closeModal('appealModal')" style="background:#666;margin-top:10px;">إلغاء</button>
        </div>
    </div>
    <div class="modal-overlay" id="notificationModal">
        <div class="modal">
            <h3>🔔 إضافة إشعار</h3>
            <form action="/admin/notifications" method="POST">@csrf<input type="text" name="title"
                    placeholder="عنوان الإشعار" required>
                <textarea name="message" rows="3" placeholder="نص الإشعار" required></textarea><button type="submit">إضافة</button>
            </form><button onclick="closeModal('notificationModal')"
                style="background:#666;margin-top:10px;">إلغاء</button>
        </div>
    </div>
    <div class="modal-overlay" id="withdrawalModal">
        <div class="modal">
            <h3>💸 سحب مبلغ</h3>
            <form action="/admin/withdrawals" method="POST">@csrf<input type="number" name="amount"
                    placeholder="المبلغ المسحوب (شيكل)" required><input type="text" name="reason"
                    placeholder="سبب السحب" required>
                <textarea name="note" rows="2" placeholder="ملاحظات (اختياري)"></textarea><button type="submit">تأكيد السحب</button>
            </form><button onclick="closeModal('withdrawalModal')"
                style="background:#666;margin-top:10px;">إلغاء</button>
        </div>
    </div>

    <script>
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
        }
        document.querySelectorAll('.modal-overlay').forEach(m => m.addEventListener('click', function(e) {
            if (e.target === this) closeModal(this.id);
        }));
    </script>
</body>

</html>
