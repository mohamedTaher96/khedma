<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class MessageController extends Controller
{
 /**
 * Show greetings
 *
 * @param Request $request [description]
 * @return [type] [description]
 */
 public function index(Request $request)
 {
     $message = trans('messages.greeting');
     $data = [
         'message'=>$message
     ];

   return response()->json($data, 200);
 }
}
