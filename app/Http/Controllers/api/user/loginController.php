<?php

namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\models\User;

class loginController extends Controller
{
    public function login(Request $request )
    {
        $user = User::where('email', $request->user)->orWhere('name', $request->user)->first();
        if($user && Hash::check($request->password,$user->password)){
            $data = (object) array('token' => $user->api_token);
            return response()->json(['message' => trans('messages.login'),'stauts'=>TRUE,'data'=>$data], 200);
        }
        return response()->json(['message' => trans('messages.notAccess'),'stauts'=>false], 404);
    }
    public function phoneVerification(Request $request )
    {
        $code = rand(1000,9999);
        $data = ['code'=>$code,'number'=>$request->number];
        return response()->json(['message' => trans('messages.login'),'stauts'=>TRUE,'data'=>$data], 200);
    }


    public function register(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'number' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $email =  User::where('email', $request->email)->first();
        if($email)
        {
            return response()->json(['message' => trans('messages.existEmail'),'stauts'=>false], 401);
        }
        $input = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/images/user');
            $image->move($destinationPath, $name);
            $data['image']=$name;
        }
        $input['password'] = Hash::make($input['password']);
        $token = array('api_token'=>Str::random(80));
        $input = array_merge((array)$input, (array)$token);
        User::create($input);

        return response()->json(['message' => trans('messages.submit'),'stauts'=>TRUE], 201);
    }
    public function forget_password(Request $request )
    {
        $user =  User::where('number', $request->number)->first();
        if($user)
        {
            // random code create and send to this number
            $code = rand(1000,9999);
            $data = (object) array('code' => $code,'token'=>$user->api_token);
            return response()->json(['message' => trans('messages.sendCode'),'stauts'=>TRUE,'data'=>$data], 200);
        }
        return response()->json(['message' => trans('messages.wrongNumber'),'stauts'=>false], 404);
    }

    public function reset_password(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $user->update(['password'=>  Hash::make($request->password)]);
            return response()->json(['message' => trans('messages.restPassword'),'stauts'=>TRUE], 200);
        }
        return response()->json(['message' => trans('messages.notAccess'),'stauts'=>false], 400);

    }


}
