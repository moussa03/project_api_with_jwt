<?php

namespace App\Http\Controllers\Api_Controller\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Traits\GeneralTrait;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController  extends Controller
{
    
    use GeneralTrait;
    public function login(Request $request)
    {

        try {
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }

            //login

            $credentials = $request->only(['email', 'password']);

            $token = Auth::guard('user-api')->attempt($credentials);

            if (!$token)
                return $this->returnError('E001', 'بيانات الدخول غير صحيحة');

            $admin = Auth::guard('user-api')->user();
            $admin->api_token = $token;
            //return token
            return $this->returnData('admin', $admin);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }
     public function profile(){
         return response()->json('this is profile');
     }
}
