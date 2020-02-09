<?php
namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\models\pageContent;
use App\models\appInfo;
use App\models\appLinks;
use App\models\message;
use App\models\User;

class appController extends Controller
{
    public function about(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $pageContnet= pageContent::where('page', 'about')->first();

            return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$pageContnet], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 401);
    }
    public function policy(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $pageContnet= pageContent::where('page', 'policy')->first();

            return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$pageContnet], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 401);
    }
    public function contact(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $appInfo = appInfo::first();
            $links = appLinks::get();
            $data = (object) array('contact' => $appInfo,'links'=>$links);
            return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$data], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 401);
    }
    public function message(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'message' => 'required',
                'type'=>'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $data = $request->all();
            message::create($data);
            return response()->json(['message' => "Successfuly Sent Message",'stauts'=>true], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 200);
    }

}
