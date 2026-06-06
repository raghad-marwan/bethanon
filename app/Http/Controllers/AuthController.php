<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Admin;
use App\Models\Organization;
use App\Models\OtpCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    // عرض صفحة الدخول
    public function showLoginForm()
    {
        return view('auth.citizen-login');
    }




    // دالة جديدة: إنشاء مستخدم حسب الـ guard
    private function createUserByGuard($guard, $nationalId, $phone)
    {
        return match ($guard) {
           

            'organization' => Organization::create([
                'national_id' => $nationalId,
                'name' => 'مؤسسة جديدة',
                'email' => $nationalId . '@org.com',
                'phone' => $phone,
                'password' => bcrypt($phone),
            ]),
            'admin' => null,
        };
    }




    // دالة مساعدة للبحث عن المستخدم حسب الـ guard
    private function findUserByGuard($guard, $nationalId)
    {
        return match ($guard) {
            'admin' => Admin::where('national_id', $nationalId)->first(),
            'organization' => Organization::where('national_id', $nationalId)->first(),

        };
    }
    public function register(Request $request)
    {
        $request->validate([
            'guard' => 'required|in:organization',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:organizations',
            'phone' => 'required',
        ]);

        Organization::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => 'ORG' . rand(100000, 999999),
            'password' => bcrypt($request->phone),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'تم إرسال طلبك للمراجعة، سيتم التواصل معك بعد الموافقة',
            'redirect' => url('/')
        ]);
    }

    public function login(Request $request)
    {
        // الإداري
        if ($request->guard === 'admin') {
            $request->validate([
                'national_id' => 'required|digits:9',
                'phone' => 'required',
            ]);

            $user = $this->findUserByGuard('admin', $request->national_id);

            if (!$user) {
                return back()->with('error', 'المستخدم غير موجود');
            }

            Auth::guard('admin')->login($user);
            return redirect('/admin/dashboard')->with('success', 'تم تسجيل الدخول');
        }

        // المؤسسة
        if ($request->guard === 'organization') {
            $request->validate([
                'email' => 'required|email',
                'phone' => 'required',
            ]);

            $user = Organization::where('email', $request->email)->first();

            if (!$user) {
                return back()->with('error', 'المستخدم غير موجود');
            }

            if ($user->status === 'pending') {
                return back()->with('status_message', 'طلبك قيد المراجعة، سيتم التواصل معك');
            }

            if ($user->status === 'rejected') {
                return back()->with('error', 'تم رفض طلب انضمامك');
            }

            Auth::guard('organization')->login($user);
            return redirect('/')->with('success', 'تم تسجيل الدخول');
        }

        return back()->with('error', 'حدث خطأ');
    }
}
