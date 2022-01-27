<?php

namespace App\Http\Controllers\Api_Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\App;
use App\Traits\GeneralTrait;
class test_api extends Controller 
{   
    use GeneralTrait;
    
    public function get_info(){
  
        $users=User::select('id','name_'.app()->getLocale())->get();
        // $users=User::all();
       
        return response()->json($users);
    }

    public function category_by_id(Request $request){

        
        $user=User::find($request->id);
        if(!$user){
            return $this->returnError('001', 'هذا القسم غير موجد');
        }
        // return response()->json($user);
        return $this->returnData('user', $user);
    }

    public function changeStatus(Request $request)
    {
       //validation
        User::where('id',$request -> id) -> update(['status' =>$request ->  active]);
        return $this -> returnSuccessMessage("sms","the message");

    }
}
