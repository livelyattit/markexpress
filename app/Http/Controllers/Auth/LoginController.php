<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
      protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'cnic';
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);

        //  return $request;

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }


        //   $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function redirectTo()
    {

        $redirect_location = route('home');

        if (Auth::check()) {

            $user_details = User::find(Auth::user()->id);
            $user_role = $user_details->role->name; // customer or owner

            switch ($user_role) {
                case 'customer':
                    $redirect_location = route('customer-dashboard');
                    break;
                case 'owner':
                    $redirect_location = route('admin-dashboard');
                    break;
                default:
                    $redirect_location = route('home');
            }
        }

        return $redirect_location;
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);


        return $request->wantsJson()
            ? response()->json([
                'data' =>
                [
                    'status' => 'success',
                    'message' => 'User logged in.',
                    'redirect_url' => $this->redirectPath()

                ]
            ])
            : redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {

        return $request->wantsJson()
            ? response()->json(
                [
                    'data' =>
                    [
                        'status' => 'error',
                        'message' => 'Invalid Credentials',
                        'redirect_url' => $this->redirectPath()
                    ]
                ],
                422
            ) : redirect()->intended($this->redirectPath());
    }


    public function showLoginForm()
    {
        $body_class = 'page-login';
        $page_title = 'Login';
        return view('auth.login', [
            'body_class' => $body_class,
            'page_title' => $page_title,
        ]);
    }
}
