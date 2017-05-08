<?php
namespace App\Http\Controllers\Auth;

use App\Mail\NewUserActivated;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class Register extends Controller
{
    /**
     * @var string
     */
    protected $redirectTo = '/members';

    /**
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['activate']]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'title' => 'Register',
            'user' => new User(['subscribed' => true]),
        ]);
    }

    /**
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6', 'confirmed'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'address1' => ['max:255'],
            'address2' => ['max:255'],
            'city' => ['max:255'],
            'state' => [Rule::in(array_keys(config('custom.states')))],
            'zip' => ['max:255'],
            'phone' => ['max:255'],
            'grad_year' => ['nullable', 'integer', 'min:1985' ,'max:2100'],
            'roll_number' => ['nullable' , 'integer', 'min:0', 'max:5000'],
            'employer' => ['max:255'],
        ]);
    }

    /**
     * @param  array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = new User($data);
        $user->password = bcrypt($data['password']);
        $user->subscribed = array_key_exists('subscribed', $data);
        $user->activate_token = Str::random(60);
        $user->save();

        return $user;
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $msg = 'You will receive an email confirmation when your account has been approved by an administrator.';
        
        $this->validator($request->all())->validate();
        event(new Registered($this->create($request->all())));

        // Clean up session in case user came in via social provider
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect()->route('login')->with('successMsg', $msg);
    }
    
    /**
     * @param  string $token
     * @return \Illuminate\Http\Response
     */
    public function activate($token)
    {
        $title = 'Activate User';
        $user = User::where([
            ['activate_token', $token],
            ['active', false],
        ])->first();

        if (!$user) return redirect('/');

        $user->active = true;
        $user->save();

        Mail::to($user->email)->queue(new NewUserActivated($user));

        return view('auth.activated', compact('title', 'user'));
    }
}
