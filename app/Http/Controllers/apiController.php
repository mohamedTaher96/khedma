<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;
use App\service;
use App\sub_service;
use App\order;
use App\offer;
use App\offer_accept;
use App\workerRate;
use App\workerComment;
use App\Worker;

use function PHPSTORM_META\type;

class apiController extends Controller
{
    public function login(Request $request )
    {
        $user = DB::table('users')->where('email', $request->user)->orWhere('name', $request->user)->first();
        if($user && Hash::check($request->password,$user->password)){
            return response()->json(['message' => 'Access Allowed','stauts'=>TRUE,'data'=>$user->api_token], 200);
        }
        return response()->json(['message' => 'Access Denied','stauts'=>false], 404);
    }

    public function submit(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $email =  DB::table('users')->where('email', $request->email)->first();
        if($email)
        {
            return response()->json(['message' => 'This email is exist'], 200);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $token = array('api_token'=>Str::random(80));
        $input = array_merge((array)$input, (array)$token);
        User::create($input);

        return response()->json(['message' => 'Successfuly Submit','stauts'=>TRUE], 201);
    }

    public function updateUser(Request $request )
    {
        $user=User::where('api_token',$request->token)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user->update($request->all());
        return response()->json(['message' => "",'stauts'=>true], 200);
    }

    public function forget_password(Request $request )
    {
        $number =  DB::table('users')->where('number', $request->number)->first();
        if($number)
        {
            // random code create and send to this number
            $code = 1234;
            return response()->json(['message' => 'Send Code','stauts'=>TRUE,'code'=>$code,'id'=>$number->id], 200);
        }
        return response()->json(['message' => "Number Doesn't Exist"], 404);
    }

    public function reset_password(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $user=User::where('api_token',$request->token);
        $user->update(['password'=>  Hash::make($request->password)]);
        return response()->json(['message' => "Password reset",'stauts'=>TRUE], 200);
    }
    public function change_password(Request $request )
    {
        $user=User::where('api_token',$request->token)->first();
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

    public function services(Request $request )
    {
        $services = service::get();
        return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$services], 200);
    }
    public function subServices(Request $request )
    {
        $subServices = sub_service::where('service_id', $request->service_id)->get();
        return response()->json(['message' => "",'stauts'=>true,'data'=>$subServices], 200);
    }
    public function order(Request $request )
    {
        $user=User::where('api_token',$request->token)->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'area' => 'required',
                'location' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $data = $request->all();
            $orderNumber =rand();
            $data['order_number']=$orderNumber;
            $data['user_id']=$user->id;
            order::create($data);
            return response()->json(['message' => "",'stauts'=>true,'data'=>['order_number'=>$orderNumber]], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 200);
    }
    public function userOrders(Request $request )
    {
        $user=User::where('api_token',$request->token)->first();
        if($user)
        {
            $waitOrders = order::where('user_id', $user->id)->where('done','no')->with('offers')->get()->toArray();

            $hiredOrder = order::where('user_id', $user->id)->where('done','hire')->with('offers')->get()->toArray();
            return response()->json(['message' => "",'stauts'=>true,'data'=>$waitOrders], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 200);
    }
    public function offers(Request $request )
    {
        $offers = offer::where('order_id', $request->order_id)->with('worker')->get();
        return response()->json(['message' => "",'stauts'=>true,'data'=>$offers], 200);
    }
    public function offerAccept(Request $request )
    {
        $validator = Validator::make($request->all(), [
            'offer_id' => 'required',
            'payment' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $data = $request->all();
        $offer_accept = offer_accept::create($data);
        return response()->json(['message' => "",'stauts'=>true,'data'=>$offer_accept], 200);
    }
    public function workerInfo(Request $request )
    {
        $worker= Worker::find($request->worker_id);
        $rates=  workerRate::where('worker_id',$request->worker_id);

        if(!$rates)
        {
            $worker_rate="";
        }else{
            $rates= $rates->pluck('rate')->toArray();
            $worker_rate = array_sum($rates)/(count($rates));
        }
        $worker->rate=$worker_rate;
        return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$worker], 200);
    }
    public function workerComment(Request $request )
    {
        $worker_comments =  workerComment::where('worker_id',$request->worker_id);
        if(!$worker_comments)
        {
            $worker_comments="";
        }else{
            $worker_comments = $worker_comments->with('user')->get();
        }
        return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$worker_comments], 200);
    }
    public function orderInfo(Request $request )
    {
        $order = order::find($request->order_id)->with('offers')->first();
        return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
    }
    public function perviousOrders(Request $request )
    {
        $order = order::where('done','done')->with('offers')->get()->toArray();;

        return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
    }
    public function perviousOrderInfo(Request $request )
    {
        $user=User::where('api_token',$request->token)->first();
        $order = order::find($request->order_id)->with('offers')->first();

        $userRate =workerRate::where('user_id',$user->id)->where('worker_id',$order->offers[0]->worker_id)->first()->rate;
        $userComment =workerComment::where('user_id',$user->id)->where('worker_id',$order->offers[0]->worker_id)->first()->comment;
        $order->userRate = $userRate;
        $order->userComment = $userComment;
        return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
    }
}
