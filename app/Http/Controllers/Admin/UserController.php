<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Role;
use App\Country;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

	public function edit() {
		$user = User::findOrFail(Auth::id());
		$country = country::all()->toArray();
		// dd($country);
		if ($user) {
			return view('admin.user',compact('user','country'));
		}else{
			return redirect()->back();
		}

	}
	public function update(Request $request) {
		$user = User::findOrFail(Auth::id());
		$input = $request->all();
		// dd($input);
		if ($input['password']) {
			$input['password']=bcrypt($input['password']);
		}else {
			$input['password'] = $user->password;
		}
		if ($user) {
			$this->validate($request,
				['name' => 'required',],
				['required' => ':attribute không được để trống!',],
				['name' => 'Tên'],
			);
			$user->update($input);
			return redirect()->back()->with('success','Edit thanh cong');
		}
		else {
			return redirect()->back()->with('success','Edit khong thanh cong');
		}
	}
    public function user_manager() {
        $user = User::with('roles')->orderBy('id','ASC')->paginate(5);
	    return view('admin.user_manager',compact('user'));
    }
    public function delete_user_role($id) {
        $user = User::findOrFail($id);
        if (Auth::id()==$id) {
            return redirect()->back()->with('danger','Lỗi: Không thể tự xóa chính mình!');
        }
        $user->roles()->detach();
        $user->delete();
        return redirect()->back()->with('success','Xóa user thành công!');
    }
    public function assign_role(Request $request) {
	    $data = $request->all();
        $user = User::where('email',$data['user_email'])->first();
        if (Auth::id()==$request->user_id) {
            return redirect()->back()->with('danger','Lỗi: Không thể tự cấp quyền chính mình!');
        }
        $user->roles()->detach();
        if ($request->adminCheck) {
            $user->roles()->attach(Role::where('name','admin')->first());
        }
        if ($request->authorCheck) {
            $user->roles()->attach(Role::where('name','author')->first());
        }
        if ($request->userCheck) {
            $user->roles()->attach(Role::where('name','user')->first());
        }
        return redirect()->back()->with('success','Cấp quyền thành công!');
    }

}





























