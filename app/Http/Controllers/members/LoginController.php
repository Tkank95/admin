<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\Controller;
use App\Models\members\User;
use App\Traits\Devices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    use Devices;

    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('admin');
        }
        return view('admin.login', [
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'signin' => 'required',
            'password' => 'required'
        ]);

        $remember = $request->has('remember_me');
        $signin = $request->input('signin');
        $pass = $request->input('password');

        // Kiểm tra đăng nhập bằng email hay username
        $type = filter_var($signin, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$type => $signin, 'password' => $pass, 'position' => [1, 2, 3, 4, 5], 'status' => 0])) {
            Session::flash('error', 'Tài khoản bị vô hiệu hoá!');
            $this->logAuth('Tài khoản bị vô hiệu hoá!', $signin, $pass, 'Failed', auth()->id());
            auth()->logout();
            return redirect()->back();
        }

        if (Auth::attempt([$type => $signin, 'password' => $pass, 'position' => [1, 2, 3], 'status' => 1], $remember)) {
            return redirect()->route('admin');
        }

        if (Auth::attempt([$type => $signin, 'password' => $pass, 'position' => [4, 5], 'status' => 1], $remember)) {
            return redirect()->away('https://www.tribeidol.com');
        }

        // Check thông tin id user để chèn vào ghi log
        $user_id = DB::table('users')->select('id')->where($type, $signin)->first();
        $message = 'Thông tin đăng nhập không đúng! Tài khoản không tồn tại';
        if (!empty($user_id)) {
            $user_id = $user_id->id;
            $message = 'Thông tin đăng nhập không đúng! Sai mật khẩu';
        }

        // Ghi log
        $this->logAuth($message, $signin, $pass, 'Failed', $user_id);
        Session::flash('error', 'Thông tin đăng nhập không đúng!');

        return redirect()->back();
    }

    public function getGoogleSignInUrl($provider): RedirectResponse
    {
        if (!Session::has('pre_url')) {
            Session::put('pre_url', URL::previous());
        } else {
            if (URL::previous() != URL::to('login')) Session::put('pre_url', URL::previous());
        }
        return Socialite::driver($provider)->redirect();
    }

    public function loginCallback($provider): RedirectResponse
    {
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        if ($authUser->status == 1) {

            // Tắt ghi nhật ký
            activity()->disableLogging();
            Auth::login($authUser, true);

            activity()->enableLogging();
            // Ghi log
            $result = [
                'name' => $authUser->name,
                'email' => $authUser->email,
                'username' => $authUser->username,
                'google_id' => $authUser->google_id,
                'login at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            activity('login')
                ->by($authUser->id)
                ->withProperty('success', $result)
                ->tap(function (Activity $activity) {
                    $activity->causer_type = 'User';
                    $activity->subject_type = \Illuminate\Support\Facades\Request::fullUrl();
                    $activity->ip = \Illuminate\Support\Facades\Request::ip();
                    $activity->agent = $this->device();
                })
                ->log('G Success');

            return redirect()->away('https://www.tribeidol.com');
        }
        Session::flash('error', 'Tài khoản bị vô hiệu hoá!');

        // Ghi log
        $this->logAuth('Tài khoản bị vô hiệu hoá! ' . $authUser->google_id, $authUser->email, $authUser->google_id, 'G Failed', $authUser->id);

        return redirect()->route('login');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('google_id', $user->id)->first();
        $authUserEmail = User::where('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }
        if ($authUserEmail && $authUser === null) {
            $authUserEmail->update(['google_id' => $user->id]);

            return $authUserEmail;
        }
        $member = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'username' => str::random(5),
            'google_id' => $user->id,
            'password' => '',
            'position' => '5',
            'avatar' => $user->avatar,
            'status' => '1',
        ]);
        $member->userInfo()->create([
            'user_id' => $user->id,
            'gender' => '0',
            'phone' => '0123456789',
            'birthday' => '2000-01-01',
            'address' => 'Chưa cập nhật',
            'facebook' => 'Chưa cập nhật',
            'team' => '',
        ]);

        return $member;
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function logAuth($message, $signin, $pass, $description, $user)
    {
        $result = [
            'message' => $message,
            'signin' => $signin,
            'value' => $pass,
            'login failed at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        activity('login')
            ->by($user)
            ->withProperty('error', $result)
            ->tap(function (Activity $activity) {
                $activity->causer_type = 'User';
                $activity->subject_type = \Illuminate\Support\Facades\Request::fullUrl();
                $activity->ip = \Illuminate\Support\Facades\Request::ip();
                $activity->agent = $this->device();
            })
            ->log($description);
    }
}
