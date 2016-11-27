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
        $name = $request->input('name');
//        $user = DB::table('users')->where('mac', $mac)->get();
//        $user = DB::select('SELECT * FROM mn_users WHERE mac = "$mac"');
        $user = User::where('mac', $mac)->where('name', $name)->first();

        if(count($user)) {
//            Auth::attempt(['name' => $name, 'mac' => $mac, $request->has('remember')]);
            Auth::guard($this->getGuard())->attempt(['name' => $name, 'mac' => $mac], $request->has('remember'));

            return redirect()->intended('home');
//            return dd($user);
        }
        else {
            return redirect('register')->with('name', $name);
        }

//        return $user;
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
        return 'name';
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

    protected function getGuard()
    {
        return property_exists($this, 'guard') ? $this->guard : null;
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
        $cluster   = Cassandra::cluster()->withContactPoints('172.17.0.2')->build();
        $keyspace  = 'mesh';
        $session   = $cluster->connect($keyspace);
        $statement = new Cassandra\SimpleStatement(
            "INSERT INTO chat (id, username, body, created_at) VALUES (cd609ead-7cae-4830-89c0-cdba47937396, '$name', '$msg', now())"
        );
        $future    = $session->executeAsync($statement);
        $session->close();

        return User::create([
            'name' => $data['name'],
            'mac' => $data['mac']
        ]);
    }
}
