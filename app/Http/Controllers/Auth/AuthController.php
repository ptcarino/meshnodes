<?php

namespace App\Http\Controllers\Auth;

//use App\Http\Requests\Request;
use App\User;
use Auth;
use DB;
use Lang;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        // Get MAC Address
        $mac=false;
        $arp=`arp -n`;
        $lines=explode("\n", $arp);

        foreach($lines as $line){
            $cols=preg_split('/\s+/', trim($line));

            if ($cols[0]==$_SERVER['REMOTE_ADDR']){
                $mac=$cols[2];
            }
        }

        return view('auth.login', compact('mac'));
    }

    public function login(Request $request) {
        $mac = $request->input('mac');
        $user = DB::table('users')->where('mac', $mac)->first();

        if(count($user)) {
            Auth::attempt(['mac' => $mac]);

            return redirect()->intended('home');
        }
        else {
            /*return redirect()->intended('login')
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);*/

            return redirect()->intended('register');
        }
    }

    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'These credentials do not match our records.';
    }

    public function loginUsername()
    {
//        return property_exists($this, 'username') ? $this->username : 'mac';
        return 'mac';
    }

    public function showRegistrationForm()
    {
        $mac=false;
        $arp=`arp -n`;
        $lines=explode("\n", $arp);

        foreach($lines as $line){
            $cols=preg_split('/\s+/', trim($line));

            if ($cols[0]==$_SERVER['REMOTE_ADDR']){
                $mac=$cols[2];
            }
        }

        /*if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }*/

        return view('auth.register', compact('mac'));
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
            'name' => 'required|max:255',
            'mac' => 'required|max:17|unique:users'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'mac' => $data['mac']
        ]);
    }
}
