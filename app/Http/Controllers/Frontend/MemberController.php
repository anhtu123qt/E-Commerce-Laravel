<?php

namespace App\Http\Controllers\Frontend;
use App\User;
use App\Role;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\loginRequest;
use App\Http\Requests\registerRequest;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\City;
use App\District;
use App\Ward;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
	public function index() {
		return view('frontend.member');
	}
	public function register(registerRequest $request) {
		$input = $request->all();
		$input['level'] = 0;
		$count = User::where('email',$input['email'])->count();
		if($count > 0){
            return redirect()->back()->with('errorReg','Email has been already registered');
        }
        if ($input['password']) {
            $input['password'] = bcrypt($input['password']);
            $new_member = User::create($input);
            $new_member->roles()->attach(Role::where('name','user')->first());
        }
        return redirect()->back()->with('success','Register Successfully!');
	}
	public function login(Request $request) {
		$login = [
			'name' => $request->namelogin,
			'password' => $request->passwordlogin,
		];
		$remember = false;
		if ($request->remember_me) {
			$remember = true;
		}
		if (Auth::attempt($login, $remember)) {
			return redirect('/index');
		}else {
			return redirect()->back()->with('error','Email or Password is not correct!');
		}
	}
	public function account() {
		$getUserid = Auth::id();
		$getInfo = User::findOrFail($getUserid);
		return view('frontend.account',compact('getUserid','getInfo'));
	}
	public function update_account(Request $request) {
		$getUserid = Auth::id();
		$getInfo = User::findOrFail($getUserid);
		$getIMG = $request->avatar;
		$getInfoUpdate = $request->all();
		if ($getIMG) {
			$getNameIMG = $getIMG->getClientOriginalName();
			$nameIMG = current(explode('.',$getNameIMG));
			$avatar = rand(0,99).'.'.$nameIMG.'.'.$getIMG->getClientOriginalExtension();
			$getIMG->move('upload/account',$avatar);
			$getInfoUpdate['avatar'] = $avatar;
			// dd($avatar);
		}
		$getInfo->update($getInfoUpdate);
		return view('frontend.account',compact('getInfo','getUserid'));
	}
	public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback(){
        $facebookUser = Socialite::driver('facebook')->user();
        $user = User::where('email',$facebookUser->getEmail())->first();
        if(!$user) {
            $user = User::create([
                'email' => $facebookUser->getEmail(),
                'name' => $facebookUser->getName(),
                'provider' => 'facebook',
                'provider_id' => $facebookUser->getId()
            ]);
        }
        Auth::login($user);
        return redirect('index');
    }
    public function redirectToGoogle() {
	    return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback() {
	    $googleUser = Socialite::driver('google')->stateless()->user();
	    $user = User::where('email',$googleUser->getEmail())->first();
	    if (!$user) {
	        $user = User::create([
	            'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'provider' => 'Google',
                'provider_id' => $googleUser->getId()
            ]);
        }
	    Auth::login($user);
	    return redirect('index');
    }
    public function forgot_password() {
	    return view('Frontend.forget_password');
    }
    public function reset_password(Request $request) {
        $recoveryEmail = $request->email;
        if (!$recoveryEmail) {
            return redirect()->back()->with('error','Email không được để trống!');
        }
        $user = User::where('email',$recoveryEmail)->first();
        if ($user) {
            $to_name = 'E Shopper';
            $to_email = $recoveryEmail;
            $link_reset_pass = url('/recovery-password?email='.$to_email.'');
            $data = array(
                'link' => $link_reset_pass,
                'name' => $user->name
            );
            Mail::send('frontend.send_mail_recovery_pass',$data,function($message) use($to_name,$to_email){
                $message->to($to_email)->subject('Bạn có 1 yêu cầu đặt lại mật khẩu');
                $message->from($to_email,$to_name);
            });
            return redirect()->back()->with('success','Email đã được gởi đi. Vui lòng xác nhận email để đặt lại mật khẩu!');
        }
        return redirect()->back()->with('error','Email không tồn tại. Mời nhập lại email!');
    }
    public function recovery_password() {
	    return view('frontend.recovery_password');
    }
    public function update_password(Request $request) {
	    $input = $request->all();
	    if ($input['confirm_pass'] !== $input['pass'] ) {
	        return redirect()->back()->with('error','Mật khẩu không giống nhau, mời nhập lại');
        }
	    $user = User::where('email',$input['email'])->first();
	    $user->password = Hash::make($input['pass'],);
	    $user->save();
	    return redirect()->back()->with('success','Đổi mật khẩu thành công! Mời quay về trang đăng nhập!');
    }
}
