<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\worker;
use App\service;
use App\sub_service;

class adminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        return view('admin/pages/home');
    }
    // public function textEditors(Request $request)
    // {
    //     return view('admin/pages/textEditors');
    // }
    public function ArTextEditors(Request $request)
    {
        return view('admin/pages/ArTextEditors');
    }
      public function EnTextEditors(Request $request)
    {
        return view('admin/pages/EnTextEditors');
    }
    //   public function contact(Request $request)
    // {
    //     return view('admin/pages/contact');
    // }
    //worker caegoryt
    public function workers(Request $request)
    {
        $items = DB::table("workers")->get();
        return view("admin/pages/workers")->with(['items'=>$items]);
    }
    //     public function newWorker(Request $request)
    // {
    //     return view('admin/pages/newWorker');
    // }
        public function addNewWorker(Request $request )
    {
            worker::create($request->all());
            return back()->with(['add'=>'true']);
    }
    //services category
        public function services(Request $request)
    {
        $items = DB::table("services")->get();
        return view('admin/pages/services')->with(['items'=>$items]);
    }
    public function pages(Request $request)
    {
        return view("admin/pages/$request->page");
    }
    public function addNewService(Request $request )
    {
        service::create($request->all());
        return back()->with(['add'=>'true']);
    }
    public function subServices($id)
    {
        $items = DB::table("sub_services")->where('service_id',$id)->get();
        return view('admin/pages/subServices')->with(['items'=>$items,'id'=>$id]);
    }
    public function newSubService ($id)
    {
        return view('admin/pages/newSubService')->with(['id'=>$id]);
    }
    public function addNewSubservice(Request $request )
    {
            sub_service::create($request->all());
            return back()->with(['add'=>'true']);
    }
                  // public function home(Request $request)
    // {
    //     return view('admin/pages/home');
    // }
                  // public function home(Request $request)
    // {
    //     return view('admin/pages/home');
    // }
}
