<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\models\worker;
use App\models\service;
use App\models\sub_service;
use App\models\pageContent;
use App\models\appInfo;
use App\models\appLinks;



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
    public function ArTextEditors(Request $request)
    {
        $aboutContent = pageContent::where('page','about')->first()->ar_content;
        $policyContent = pageContent::where('page','policy')->first()->ar_content;
        return view('admin/pages/ArTextEditors')->with(['aboutContent'=>$aboutContent,'policyContent'=>$policyContent]);
    }
    public function arTextChange(Request $request)
    {
        $page = $request->page;
        pageContent::where('page',"$request->page")->first()->update(['ar_content'=>$request->$page]);
        return redirect('/pages/ar')->with(['edit'=>'true']);
    }
      public function EnTextEditors(Request $request)
    {
        $aboutContent = pageContent::where('page','about')->first()->en_content;
        $policyContent = pageContent::where('page','policy')->first()->en_content;
        return view('admin/pages/EnTextEditors')->with(['aboutContent'=>$aboutContent,'policyContent'=>$policyContent]);
    }
    public function enTextChange(Request $request)
    {
        $page = $request->page;
        pageContent::where('page',"$request->page")->first()->update(['en_content'=>$request->$page]);
        return redirect('/pages/en')->with(['edit'=>'true']);;
    }
      public function contact(Request $request)
    {
        $appInfo = appInfo::first();
        $links = appLinks::get();
        return view('admin/pages/contact')->with(['appInfo'=>$appInfo,'links'=>$links]);
    }
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
        $validator = Validator::make($request->all(), [
            'city' => 'required',
            'area' => 'required',
            'location' => 'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $data = $request->all();
        if ($request->hasFile('help_image')) {
            $image = $request->file('help_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/images/worker');
            $image->move($destinationPath, $name);
            $data['image']=$name;
        }
            worker::create($data);
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
