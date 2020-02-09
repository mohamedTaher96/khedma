<?php
namespace App\Http\Controllers\api\user;
use App\Http\Controllers\Controller;
use App\models\User;
use Illuminate\Http\Request;
use App\models\workerRate;
use App\models\workerComment;
use App\models\Worker;

class workerController extends Controller
{
    public function workerInfo(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
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
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
    public function workerComment(Request $request )
    {
        $user=User::where('api_token',$request->header('Authorization'))->first();
        if($user)
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
        return response()->json(['message' => "Access denied",'stauts'=>false], 400);
    }
}
