<?php
namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\User;
use App\models\order;
use App\models\workerRate;
use App\models\workerComment;
use App\models\service;
use App\models\sub_service;

class orderController extends Controller
{
    public function services(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            
            $services = service::get();

            return response()->json(['message' => "",'stauts'=>TRUE,'data'=>$services], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 401);
    }
    public function subServices(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $subServices = sub_service::where('service_id', $request->service_id)->get();
            return response()->json(['message' => "",'stauts'=>true,'data'=>$subServices], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 401);
    }
    public function order(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $validator = Validator::make($request->all(), [
                'city' => 'required',
                'area' => 'required',
                'location' => 'required',
                'help_image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $data = $request->all();
            if ($request->hasFile('help_image')) {
                $image = $request->file('help_image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = storage_path('/images/order');
                $image->move($destinationPath, $name);
                $data['help_image']=$name;
            }
            $orderNumber =rand();
            $data['order_number']=$orderNumber;
            $data['user_id']=$user->id;
            order::create($data);
            return response()->json(['message' => "Successfuly order",'stauts'=>true,'data'=>['order_number'=>$orderNumber]], 200);
        }
        return response()->json(['message' => "Access Denied",'stauts'=>false], 200);
    }
    public function userOrders(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $waitOrders = order::where('user_id', $user->id)->where('done','no')->with('offers')->get()->toArray();
            $hiredOrders = order::where('user_id', $user->id)->where('done','hire')->with('offers')->get()->toArray();
            $data = (object) array('waitOrders' => $waitOrders,'hireOrders'=>$hiredOrders);
            return response()->json(['message' => "",'stauts'=>true,'data'=>$data],200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function orderInfo(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $order = order::find($request->order_id)->with('offers')->first();
            return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function perviousOrders(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $order = order::where('done','done')->with('offers')->get()->toArray();;
            return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function perviousOrderInfo(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $order = order::find($request->order_id)->with('offers')->first();
            $userRate =workerRate::where('user_id',$user->id)->where('worker_id',$order->offers[0]->worker_id)->first()->rate;
            $userComment =workerComment::where('user_id',$user->id)->where('worker_id',$order->offers[0]->worker_id)->first()->comment;
            $order->userRate = $userRate;
            $order->userComment = $userComment;
            return response()->json(['message' => "",'stauts'=>true,'data'=>$order], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }

}
