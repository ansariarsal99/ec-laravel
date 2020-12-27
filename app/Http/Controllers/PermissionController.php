<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleViewCollection;
use App\Http\Resources\UrlPermissionCollection;
use App\Http\Resources\AdminCollection;
use App\UrlPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests, DB, Session, Response;
use App\Admin;
//use Illuminate\Validation\Validator;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construc()
    {
            $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function roles(Request $request){

        $data = $request->all();
        $page = 'roles';

        $roles = Role::all();
        $data = new RoleViewCollection($roles);
        $data = $data->toArray(\request());
        $columns = [];

        if(count($data) > 0) {
            $columns = array_keys($data[0]);
        }

        $actions = [
            [
                'label' => 'Delete',
                'action' => route('admin.roles.delete', ':id')
            ],
        ];




        return view('admin.permissions.roles.index',compact('page', 'data', 'columns', 'actions'));

    }

    public function getRoles(Request $request){

        $data = $request->all();
        $page = 'roles';
        return view('admin.permissions.roles.index',compact('page'));

    }

    public function addRoles(Request $request){

        $payload = $request->except('_token');


        $name = $payload['name'];
        $name = str_replace(" ", "_", strtolower($name)) ;
        if(!Role::where('name', $name)->first()){
            Role::create(['name' => $name]);
        }

        Session::flash('success', 'New role added successfully');

        return redirect()->back();
    }

    public function deleteRoles(Request $request, $id){

        $data= Role::where('id', $id)->first();
        if(!empty($data)){
            $dataDeleted = Role::where('id', $id)->first()->delete();
            // Session::flash('success','Country is deleted successfully');
            return $response = array('status'=>'ok');
        }
    }

    public function permissions(Request $request){

        $data = $request->all();
        $page = 'permissions';

        $roles = Role::all();


        // get urls to permit
        $urls = [];
        foreach(\Route::getRoutes() as $route)
        {

            $urls[] = $route->uri;

        }

        $filteredArray = \Arr::where($urls, function ($value, $key) {
            $v = explode('/', $value);
            return $v[0] == 'admin';
        });


        $d = UrlPermission::all();
        $data = new UrlPermissionCollection($d);
        $data = $data->toArray(\request());
        $columns = [];

        if(count($data) > 0) {
            $columns = array_keys($data[0]);
        }

        $actions = [
            [
                'label' => 'Delete',
                'action' => route('admin.permissions.delete', ':id')
            ],
        ];




        return view('admin.permissions.permissions.index',compact('page', 'data', 'columns', 'actions', 'roles', 'filteredArray'));

    }

    public function addPermission(Request $request){

        $payload = $request->except('_token');
        $name = $payload['name'];
        $name = str_replace(" ", "_", strtolower($name)) ;
        $role_id = $payload['role_id'];
        $urls = implode(",",$payload['urls']);

        if(Role::where('id', $role_id)->first()){
            UrlPermission::updateOrCreate([
               'name' => $name,
               'role_id' => $role_id,
               'urls' => $urls
            ], ['name' => $name ]);
        }

        Session::flash('success', 'New permission added successfully');
        return redirect()->back();

    }

    public function deletePermission(Request $request, $id){

        $data= UrlPermission::where('id', $id)->first();
        if(!empty($data)){
            $dataDeleted = UrlPermission::where('id', $id)->first()->delete();
            // Session::flash('success','Country is deleted successfully');
            return $response = array('status'=>'ok');
        }
    }



    public function admins(Request $request)
    {
        
       $roles = Role::all(); 
        
       // $data = Admin::all();
       $page =  'admins';
       $d = Admin::all();
       $data = new AdminCollection($d);
       $data = $data->toArray(\request());
       $columns = [];

       if(count($data) > 0) {
           $columns = array_keys($data[0]);
       }

       $actions = [
           [
               'label' => 'Delete',
               'action' => route('admin.admins.delete', ':id')
               

            ],
       ];
       
       
       return view('admin.permissions.admins.index',compact('page','data', 'columns','actions','roles'));
    }
    
    
    
    public function addAdmins(Request $request){

        $payload = $request->except('_token');

        $validator = \Validator::make($request->all(), [ 
            'type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:admins',
            'phone_no' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Error Adding Admin');
            return redirect()->back();    
        };



        $type = $payload['type'];
        $type = str_replace(" ", "_", strtolower($type)) ;
        $first_name = $payload['first_name'];
        $first_name = str_replace(" ", "_", strtolower($first_name)) ;
        $last_name = $payload['last_name'];
        $last_name = str_replace(" ", "_", strtolower($last_name)) ;
        $address = $payload['address'];
        $email = $payload['email'];
        $phone_no = $payload['phone_no'];
       
        
        Admin::create([
               'type'=> $type,
               'first_name' => $first_name,
               'last_name' => $last_name,
               'address' => $address,
               'email' => $email,
               'phone_no' => $phone_no,
               'password'=> '123asd',
        ]); 
        
    

        Session::flash('success', 'New permission added successfully');
        return redirect()->back();

/*         $user_id = \auth()->user()->id;
        $data = $request->all();

        $validator = \Validator::maker($request->all(), [ 
            'type' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_no' => 'required',
        ],[
            "type" => "type Field is Missing",
            "first_name" => "Name Field is Missing",
            "last_name" => "last Name Field is Missing",
            "email" => "Email Field is Missing",
            "phone_no" => "Phone Field is Missing",
        ]);

        if ($validator->fails()) {
            return self::failure($validator->errors()->first());
         };

        $data['status'] = config( key: 'job.status.PENDING');
        $job = new Job($data);
        $job->security_code = Helper::incrementalHash( num: 6);
        $job->save(); */


    }
        public function deleteAdmins(Request $request, $id)
        {

            $data= Admin::where('id', $id)->first();
 
            if(!empty($data)){
                $dataDeleted = Admin::where('id', $id)->first()->delete();
                
                return $response = array('status'=>'ok');
            }
        }

        public function editAdmins(Request $request)
        {

            $data= Admin::findorFail($id);
            if(!empty($data)){
                $dataDeleted = Admin::where('id', $id)->get()->edit();
                
                return $response = array('status'=>'ok');
            }
        }
 
 
 
  public function allUserListIndex(Request $request) 
   {
        $sellerList = Admin::leftjoin('user_types','users.user_type_id','user_types.id')
                         ->select('users.*','user_types.name as user_type_name')
                         // ->where('user_type_id',6)                           
                         ->where('complete_profile','yes')
                         ->get();
 
        return DataTables::of($sellerList)
               ->addIndexColumn()
 
                ->editColumn('city',function($sellerList) {
                   if($sellerList->city!=null){      
                       $city =  $sellerList->city;
                   }else{
                       $city= '-';
                   }
                   return $city;
               })  
 
               ->editColumn('supplier_code',function($sellerList) {
                    if($sellerList->supplier_code!=null){      
                        $supplier_code =  $sellerList->supplier_code;
                    }else{
                        $supplier_code= '-';
                    }
                    return $supplier_code;
                }) 
 
               ->editColumn('company_name',function($sellerList) {
                    if($sellerList->company_name!=null){      
                        $company_name =  $sellerList->company_name;
                    }else{
                        $company_name= '-';
                    }
                    return $company_name;
                }) 
 
               ->addColumn('status', function ($sellerList) {
                   return '<div class="status_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->status . '" id="status_button_' . $sellerList->id . '"></div>';
               })
 
               ->addColumn('transaction_status', function ($sellerList) {
                   return '<div class="transaction_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->transaction_status . '" id="status_button_trans_' . $sellerList->id . '"></div>';
               })
 
               ->addColumn('certified_provider', function ($sellerList) {
                   return '<div class="certified_provider_button_toggle" ral="' . $sellerList->id . '" rel="' . $sellerList->certified_provider . '" id="status_button_certi_' . $sellerList->id . '"></div>';
               }) 
 
               ->addColumn('action', function ($sellerList) {
                   return 
                   '<a href="' . url("admin/permissions/permissions/check".base64_encode($sellerList->id)) . '" class="edit-btn"> <i class="fa fa-eye" title="Detail"></i></a>
                   <a href="' . url("admin/permissions/permissions/check".base64_encode($sellerList->id)) . '" class="User"> <i class="fa fa-user" title="Designer Store Location"></i></a>';
                 })
               ->escapeColumns([])
               ->make(true);                                          
    }





}
