<?php
namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;
use App\message;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\models\User;

class userController extends Controller
{
    public function userInfo(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$user], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function updateUserInfo(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'number' => 'required',
                'email' => 'required|email',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $data = $request->all();
            if ($request->hasFile('image')) {
                $validator = Validator::make($request->all(), [
                    'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);
                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()], 401);
                }
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/images/user');
                $image->move($destinationPath, $name);
                $data['image']=$name;
            }
            $user->update($data);
            return response()->json(['message' => "user updated",'stauts'=>TRUE], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function change_password(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            if(Hash::check($request->old_password, $user->password))
            {
                $user->update(['password'=>  Hash::make($request->new_password)]);
                return response()->json(['message' => "Password reset",'stauts'=>TRUE], 200);
            }else{
                return response()->json(['message' => "Invalid Passwor",'stauts'=>false], 404);
            }
        }
        return response()->json(['message' => "Password reset",'stauts'=>false], 200);
    }

}
