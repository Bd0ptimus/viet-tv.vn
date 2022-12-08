<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


use App\Services\UserService;
use App\Services\AccountService;
use App\Mail\AccountDetailSend;

use App\Models\User;
class AdminController extends Controller
{
    protected $userService;
    protected $accountService;
    public function __construct(UserService $userService, AccountService $accountService){
        $this->middleware('admin.permission');
        $this->userService = $userService;
        $this->accountService = $accountService;
    }
    public function index(){
        $users = $this->userService->takeAllUserForAccountManager();
        // dd($users);
        return view('admin.accountManager.index',[
            'admins' => $users['admins'],
            'users' => $users['users'],
        ]);
    }

    private function registerValidate($request){
        $messages = [
            'name.required' => 'Tên bắt buộc phải được nhập.',
            'expiredDate.required' => 'Tên bắt buộc phải được nhập.',
            'name.max' => 'Tên chỉ có tối đa 255 ký tự.',
            'email.max' => 'Email chỉ có tối đa 255 ký tự',
            'after' => 'Ngày hết hạn phải sau ngày hôm nay',
            'numDevices.numeric' => 'Số lượng thiết bị phải là số',
            'numDevices.min' => 'Số lượng thiết bị tối thiểu là 1',
            'numDevices.max' => 'Số lượng thiết bị tối đa là 99',
            'numDevices.required' => 'Số lượng thiết bị phải được nhập',

        ];

        $validator = Validator::make($request, [
            'name'    => 'required|max:255',
            'email'    => 'sometimes|nullable|email|max:255',
            'expiredDate'=>'required|after:yesterday',
            'numDevices' => 'required|numeric|min:1|max:99',
        ], $messages);

        return $validator;
    }

    public function createAccount(Request $request, $accountType){
        if($request->isMethod('POST')){
            $validator = $this->registerValidate($request->all());
            if ($validator->fails()) {
                // dd($validator);
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            } else {
                if($request->country==0){
                    return redirect()->back()->withErrors($validator->errors()->add('country', 'Phải chọn quốc gia'))->withInput($request->all());
                }
                if(!str_contains($request->phoneNumber, '+')){
                    $validator->errors()->add('phone', 'Định dạng số điện thoại không đúng');
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $newAccount=$this->accountService->createAccount($request, $accountType);
                return view('layouts.accountCreateConfirm',[
                    'newUser'=>$newAccount,
                    'accountType'=>$accountType,
                ]);
            }
        }
        return view('auth.register',[
            'accountType'=>$accountType,
        ]);
    }

    public function sendAccountDetailToUser(Request $request, $userId, $pageId){

        try{
            $user = User::find($userId);
            Mail::to($user->email)->send(new AccountDetailSend($user->email, $user->name, $user->username, $user->password_raw));
            if($pageId ==CREATE_ACC_CONFIRMATION_PAGE ){
                return view('layouts.accountCreateConfirm',[
                    'newUser'=>$user,
                    'accountType'=>$user->role_user,
                    'sendMailComplete'=>1,
                ]);
            }elseif($pageId ==ADMIN_PAGE){
                $users = $this->userService->takeAllUserForAccountManager();
                return view('admin.accountManager.index',[
                    'admins' => $users['admins'],
                    'users' => $users['users'],
                    'sendMailComplete'=>1,
                ]);
            }



        }catch(\Exception $e){
            if($pageId ==CREATE_ACC_CONFIRMATION_PAGE ){
                return view('layouts.accountCreateConfirm',[
                    'newUser'=>$user,
                    'accountType'=>$user->role_user,
                    'sendMailComplete'=>0,
                ]);
            }elseif($pageId ==ADMIN_PAGE){
                $users = $this->userService->takeAllUserForAccountManager();
                return view('admin.accountManager.index',[
                    'admins' => $users['admins'],
                    'users' => $users['users'],
                    'sendMailComplete'=>0,
                ]);
            }
        }
    }

    public function suspendAccount(Request $request, $userId){
        User::find($userId)->update([
            'active' => USER_SUSPENDED,
        ]);
        return redirect()->back();
    }

    public function activeAccount(Request $request, $userId){
        User::find($userId)->update([
            'active' => USER_ACTIVATED,
        ]);
        return redirect()->back();
    }

    public function changePassword(Request $request){
        User::find($request->userId)->update([
            'password' => Hash::make($request->password),
            'password_raw' => $request->password,
        ]);
        $users = $this->userService->takeAllUserForAccountManager();
        return view('admin.accountManager.index',[
            'admins' => $users['admins'],
            'users' => $users['users'],
            'sendChangePasswordComplete'=>1,

        ]);
    }

    private function changeInfoValidate($request){
        $messages = [
            'expiredDate.required' => 'Tên bắt buộc phải được nhập.',
            'email.max' => 'Email chỉ có tối đa 255 ký tự',
            'after' => 'Ngày hết hạn phải sau ngày hôm nay',
            'numDevices.numeric' => 'Số lượng thiết bị phải là số',
            'numDevices.min' => 'Số lượng thiết bị tối thiểu là 1',
            'numDevices.max' => 'Số lượng thiết bị tối đa là 99',
            'numDevices.required' => 'Số lượng thiết bị phải được nhập',
            'username.required' => 'Tên đăng nhập phải được nhập',
            'username.min' => 'Tên đăng nhập phải có ít nhất 10 ký tự',
            'username.max' => 'Tên đăng nhập chỉ có tối đa 255 ký tự',
        ];

        $validator = Validator::make($request, [
            'email'    => 'sometimes|nullable|email|max:255',
            'expiredDate'=>'required|after:yesterday',
            'numDevices' => 'required|numeric|min:1|max:99',
            'username' => 'required|min:10|max:255',

        ], $messages);

        return $validator;
    }

    public function changeInfoAccount(Request $request, $userId){
        if($request->isMethod('POST')){
            $validator = $this->changeInfoValidate($request->all());
            if ($validator->fails()) {
                // dd($validator);
                return redirect()->back()->withErrors($validator)->withInput($request->all());
            } else {
                $user = User::where('username', '=', $request->username)->first();
                if(isset($user)){
                    if($user->id != $userId){
                        return redirect()->back()->withErrors($validator->errors()->add('username', 'Tên đăng nhập đã tồn tại, hãy chọn tên đăng nhập khác'))->withInput($request->all());
                    }
                }
                if($request->country==0){
                    return redirect()->back()->withErrors($validator->errors()->add('country', 'Phải chọn quốc gia'))->withInput($request->all());
                }

                if(!str_contains($request->phoneNumber, '+')){
                    $validator->errors()->add('phone', 'Định dạng số điện thoại không đúng');
                    return redirect()->back()->withErrors($validator)->withInput($request->all());
                }
                $this->accountService->updateAccount($request, $userId);
                return redirect()->route('admin.accountManager');
            }
        }
        return view('admin.accountManager.changeInfoAccount',[
            'user'=>User::find($userId),
        ]);
    }

    public function changeStatus(Request $request, $type, $userId){
        User::find($userId)->update([
            'active' => $type,
        ]);
        return redirect()->back();
    }
}
