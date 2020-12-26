<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use App\State;
use App\Country;
use DataTables;

class StateController extends Controller
{
    public function stateList(Request $request){
         $countries = Country::orderBy('name', 'asc')->get();  
        // dd($stateList);                       
        $page = 'states';
        return view('admin.generalManagement.state.stateList',compact('page','countries'));
    }
    public function stateListIndex(Request $request){

        $stateList =State::leftjoin('countries','states.country_id','countries.id')
                             ->select('states.*','countries.name as country_id','countries.id as cntryId');
        $url = url('/');  
        return DataTables::of($stateList)   
                          ->addIndexColumn()
                          ->addColumn('status', function ($row) {
                            return '<div class="status_button_toggle" ral="'.$row->id.'" rel="'.$row->status.'" id="status_button_'.$row->id.'"></div>';
                          })

                        ->addColumn('action', function($row) use($url){
                            return '<a href="javascript:void(0)" class="edit_course" ral_state_id="'.$row->id.'" ral_state_name="'.$row->name.'" ral_country_id="'.$row->cntryId.'" data-toggle="modal" data-target="#editStateModal"><i class="fa fa-edit" title="Edit"></i></a>
                            
                             <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($row->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                           })   

                          ->escapeColumns([])
                          ->make(true);           


    }

    public function changeStatus(Request $request)
    {
        if($request->status && $request->id){
            $statusChanged = State::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

     public function addState(Request $request){
        $payload = $request->except('_token');
        State::create($payload);
        Session::flash('success', 'New state is added successfully');   

        return redirect()->back();
    }

    public function updateState(Request $request){
         $payload = $request->except('_token','name');
        // dd($payload);
        $courseData = State::where('id',$request->input('id'))->first();
        // dd($courseData);
        $courseData->update($payload);
        Session::flash('success', 'State is updated successfully');   
        return redirect()->back();   
    }

    public function deleteState($id, Request $request)
    {   
        $data= State::where('id', base64_decode($id))->first();
        if(!empty($data)){
          $dataDeleted = State::where('id', base64_decode($id))->first()->delete();
          // Session::flash('success','State is deleted successfully');
          return $response = array('status'=>'ok');
        }

    }

    public function validateStateName(){

    $name = $_GET['name'];
    $nameCount = State::where('name',$name)->count();

    if ($nameCount >0) {
        $resp = 'false';
    }else{
        $resp = 'true';
    }
       return $resp;
    }


    public function validateEditStateName( Request $request){
        $data = $request->all();
        // dd('here');
            // dd($data);        
        $name = @$data['name'];
        
        if ($data['id'] == null) {
            
            $count = State::where('name',$name)->count();;
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = State::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }
}
