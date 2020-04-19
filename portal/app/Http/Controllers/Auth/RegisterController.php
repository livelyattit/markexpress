<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Rules\CnicNumber;
use App\Rules\PhoneNumber;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', new PhoneNumber],
            'cnic' => ['required', new CnicNumber, 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
            [
                'cnic.unique'=>'Cnic is already associated to some other account.'
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'cnic' => $data['cnic'],
            'role_id'=>3, // 3 is for customer for now
            'originality_verified'=> 0, // 0 means not verified by the admin
            'password' => Hash::make($data['password']),
        ]);
    }

    public function redirectTo()
    {

        $redirect_location = route('home');

        if (Auth::check()) {

            $user_details =    User::find(Auth::user()->id);
            $user_role = $user_details->role->role; // customer or admin

            switch ($user_role) {
                case 'customer':
                    $redirect_location = route('customer-dashboard');
                    break;
                case 'admin':
                    $redirect_location = route('admin-dashboard');
                    break;
                default:
                    $redirect_location = route('home');
            }
        }

        return $redirect_location;
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

         $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        return $request->wantsJson()
                    ? response()->json([
                        'data'=>
                        [
                            'status'=>'success',
                             'message'=>'User Registered.',
                             'redirect_url' => $this->redirectPath()

                        ]
                    ])
                    : redirect()->intended($this->redirectPath());
    }



    public function showRegistrationForm()
    {
        $body_class = 'page-register';
        $page_title = 'Register';
        return view('auth.register', [
            'body_class'=>$body_class,
            'page_title'=>$page_title,
        ]);
    }
}
