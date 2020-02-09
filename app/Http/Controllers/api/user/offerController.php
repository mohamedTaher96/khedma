<?php
namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;
use App\models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\offer;
use App\models\offer_accept;

class offerController extends Controller
{

    public function offers(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
        {
            $offers = offer::where('order_id', $request->order_id)->with('worker')->get();
            return response()->json(['message' => "",'stauts'=>true,'data'=>$offers], 200);
        }
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function offerAccept(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
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
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);

    }
}
