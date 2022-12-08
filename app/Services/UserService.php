<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;
use Carbon\Carbon;

//model
use App\Models\User;
use App\Models\ForgotPassword;
//repo

use Exception;
class UserService
{
    public function takeAllUserForAccountManager(){
        $response['admins'] = User::where('role_user', ROLE_ADMIN)->get();
        $response['users'] = User::where('role_user', ROLE_USER)->get();
        return $response;
    }

    public function createToken($userId){
        $token = $this->getToken();
        ForgotPassword::where('user_id', $userId)->delete();
        ForgotPassword::create([
            'user_id' => $userId,
            'token' =>$token,
        ]);
        return $token;
    }

    private function getToken(){
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

}
