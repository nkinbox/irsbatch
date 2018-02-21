<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    private $otp = false;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username() {
        return "membership_code";
    }
    protected function credentials(Request $request)
    {   
        if(is_null($request->password)) {
            return [
                'membership_code' => $request->{$this->username()},
                'mobile_no' => $request->phone_no,
                'membership' => 1,
            ];
        } else {
            return [
                'membership_code' => $request->{$this->username()},
                'password' => $request->password,
                'mobile_no' => $request->phone_no,
                'membership' => 1,
            ];
        }
    }
    protected function validateLogin(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            $this->username() => 'required|string',
            'phone_no' => 'required|digits:10',
            'password' => 'nullable|string',
        ]);
    }
    protected function attemptLogin(Request $request)
    {   /*
        dd($this->credentials($request));
        dd($this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        ));*/
        //dd($request);
        if(is_null($request->password)) {
            $user = User::select('id')->where($this->credentials($request))->first();
            if(!is_null($user)){
                $this->otp = true;
                $otp = '1234';
                $user->password = bcrypt($otp);
                $user->save();
            }
            return false;
        }
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        if($this->otp) {
            $message = [
                $this->username() => ["OTP Sent on " .substr($request->phone_no, 0, 2). "xxxxxx" .substr($request->phone_no, -2, 2). "."],
                "otp" => true
            ];
        } else{
            $message = [
                $this->username() => [trans('auth.failed')],
            ];
        }
        
        throw ValidationException::withMessages($message);
    }
    protected function authenticated(Request $request, $user)
    {   switch($request->mode) {
            case "member":
            $mode = "member";
            break;
            case "lobbyhead":
            if($user->position_id == 1 || $user->position_id == 11)
            $mode = "lobbyhead";
            else
            $mode = "member";
            break;
            case "corecommittee":
            if($user->position_id > 0 && $user->position_id < 11)
            $mode = "corecommittee";
            else
            $mode = "member";
            break;
            case "president":
            if($user->position_id == 1)
            $mode = "president";
            else
            $mode = "member";
            break;
            default:
            $mode = "member";
        }
        session(["mode" => $mode]);
    }
    public function logout(Request $request)
    {
        $user = User::find(Auth::id());
        $user->password = null;
        $user->save();
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
