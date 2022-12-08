<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Str;
use Carbon\Carbon;
use  App\Http\Controllers\Util;

//model
use App\Models\User;
//repo

use Exception;
class AccountService
{
    private function generatePassword(){
        $length = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzQWERTYUIOPASDFGHJKLZXCVBNM';
        $password = "";

        for ($p = 0; $p < $length; $p++) {
            @$password .= $characters[mt_rand(0, strlen($characters))];
        }
        return $password;
    }

    private function generateUsername($data,$accountType){
        $username =Util::convert_vi_to_en($data->name);
        $username = str_replace(' ', '', $username);
        $username = strtolower($username);
        if($accountType == ROLE_ADMIN){
            $username = $username.'-2'.'-';
        }elseif($accountType == ROLE_USER){
            $username = $username.'-3'.'-';
        }else{
            $username = $username.'-1'.'-';
        }
        $otherSameInDb = User::where('username','like','%'.$username.'%')->orderBy('updated_at', 'ASC')->get();
        $numberOverlap = count($otherSameInDb);
        // dd(explode('-',$otherSameInDb[$numberOverlap-1]->username)[2] + 1);

        if($numberOverlap>0){
            $index = explode('-',$otherSameInDb[$numberOverlap-1]->username)[2] + 1;
            $username = $username.$index;
            // dd($username);
        }else{
            $username = $username.'1';
        }
        return $username;
    }

    public function createAccount($data, $accountType){
        $username = $this->generateUsername($data,$accountType);
        $password = $this->generatePassword();
        return User::create([
            'name'=> $data->name,
            'username'=>$username,
            'email'=>$data->email??'',
            'password'=>Hash::make($password),
            'password_raw'=>$password,
            'role_user'=>$accountType,
            'active'=>$accountType==ROLE_USER?WAITING_PAY:USER_ACTIVATED,
            'expired_date'=>date("Y-m-d", strtotime($data->expiredDate)),
            'number_devices'=>$data->numDevices,
            'country' =>$data->country,
            'phone' => $data->phone,
        ]);
    }

    public function suspendAllAccountExpired(){
        $now = Carbon::now()->toDateString();
        User::where('expired_date', '<',$now)->update([
            'active'=>USER_SUSPENDED,
        ]);
    }

    public function updateAccount($data, $userId){
        return User::where('id', $userId)->update([
            'email'=>$data->email??'',
            'expired_date'=>date("Y-m-d", strtotime($data->expiredDate)),
            'number_devices'=>$data->numDevices,
            'username'=>$data->username,
            'country' => $data->country,
            'phone' => $data->phone,
        ]);
    }

}
