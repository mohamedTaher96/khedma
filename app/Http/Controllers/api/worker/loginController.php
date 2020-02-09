<?php

namespace App\Http\Controllers\api\worker;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\models\worker;
use App\models\User;

class loginController extends Controller
{
    public function login(Request $request )
    {
        $worker = worker::where('email', $request->user)->orWhere('number', $request->user)->first();
        if($worker && Hash::check($request->password,$worker->password)){
            $data = (object) array('token' => $worker->api_token);
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
            'directions' => 'required',
            'city' => 'required',
            'adress' => 'required',
            'area' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $email =  worker::where('email', $request->email)->first();
        if($email)
        {
            return response()->json(['message' => trans('messages.existEmail'),'stauts'=>false], 401);
        }
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/images/worker');
            $image->move($destinationPath, $name);
            $data['image']=$name;
        }
        $data['number']=$request->number;
        $data['password'] = Hash::make($data['password']);
        $token = array('api_token'=>Str::random(80));
        $data = array_merge((array)$data, (array)$token);
        worker::create($data);
        $data=['name'=>$data['name'],'token'=>$token['api_token']];
        return response()->json(['message' => trans('messages.submit'),'stauts'=>TRUE,'data'=>$data], 201);
    }
    public function forget_password(Request $request )
    {
        $worker =  worker::where('number', $request->number)->first();
        if($worker)
        {
            // random code create and send to this number
            $code = rand(1000,9999);
            $data = (object) array('code' => $code,'token'=>$worker->api_token);
            return response()->json(['message' => trans('messages.sendCode'),'stauts'=>TRUE,'data'=>$data], 200);
        }
        return response()->json(['message' => trans('messages.wrongNumber'),'stauts'=>false], 404);
    }
    public function reset_password(Request $request )
    {
        $worker=worker::where('api_token',$request->header('Authorization'))->first();
        if($worker)
        {
            $validator = Validator::make($request->all(), [
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $worker->update(['password'=>  Hash::make($request->password)]);
            return response()->json(['message' => trans('messages.restPassword'),'stauts'=>TRUE], 200);
        }
        return response()->json(['message' => trans('messages.notAccess'),'stauts'=>false], 400);

    }

}
