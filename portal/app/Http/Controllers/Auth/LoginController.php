<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        // if (method_exists($this, 'hasTooManyLoginAttempts') &&
        //     $this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
     //   $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        // if ($response = $this->authenticated($request, $this->guard()->user())) {
        //     return $response;
        // }

        return $request->wantsJson()
                    ? response()->json([
                        'data'=>
                        [
                            'status'=>'success',
                             'message'=>'User logged in.'
                        ]
                    ])
                    : redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);

        return $request->wantsJson()
                    ? response()->json(
                       [ 'data'=>
                        [
                            'status'=>'error',
                             'message'=>'Invalid Credentials',
                        ]
                       ]
                   , 422 ) :  [ 'data'=>
                    [
                        'status'=>'error',
                         'message'=>'Invalid Credentials'
                    ]
                   ] ;


    }


    public function showLoginForm()
    {
        $body_class = 'page-login';
        $page_title = 'Login';
        return view('auth.login', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
        ]);
    }


}
