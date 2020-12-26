<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoleViewCollection;
use App\Http\Resources\UrlPermissionCollection;
use App\UrlPermission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests, DB, Session, Response;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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





}
