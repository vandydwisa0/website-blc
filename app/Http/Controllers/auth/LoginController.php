<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';
    protected $auth;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FirebaseAuth $auth)
    {
        $this->middleware('guest')->except('logout');
        $this->auth = $auth;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function login(Request $request)
    {
        try {
            $signAttributes = $this->auth->signInWithEmailAndPassword($request['email'], $request['password']);
            $user = new User($signAttributes->data());

            $uid = $signAttributes->firebaseUserId();
            Session::put('uid', $uid);

            $firebase = app('firebase.firestore')->database();
            $getUser = $firebase->collection('users')->document($uid)->snapshot();

            if ($getUser->data()['role'] == 'manager' || $getUser->data()['role'] == 'admin' || $getUser->data()['role'] == 'director') {
                $userDetails = app('firebase.auth')->getUser($uid);
                Session::put('role', $getUser->data()['role']);
                Session::put('name', $getUser->data()['name']);

                Alert::success('Success', 'Login Berhasil');
                return redirect('/admin/dashboard'); // bere route
            }

            Session::flush();
            return redirect()->back();
        } catch (FirebaseException $exception) {
            Alert::error('Error', 'Login Gagal');
            return redirect()->back();
        }
    }

    public function username()
    {
        return 'email';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flush('uid');
        Session::flush('role');

        return redirect('login');
    }
}