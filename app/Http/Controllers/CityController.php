<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use App\State;
use App\Country;
use App\City;
use DataTables;

class CityController extends Controller
{
      public function cityList(Request $request){ 

        $countries = Country::orderBy('name', 'asc')->get();  
        $states    = State::orderBy('name', 'asc')->get();  
        $page = 'cities';
        return view('admin.generalManagement.city.cityList',compact('page','countries','states'));
    }
    public function cityListIndex(Request $request){

       // $stateList =City::leftjoin('states','cities.state_id','states.id')
       //                  ->leftjoin('countries','states.country_id','countries.id')
       //                  ->select('cities.*','states.name as state_id','states.id as stat_id','countries.id as countryy_id','countries.name as country_id');

        $stateList =City::leftjoin('states','cities.state_id','states.id')
                        ->leftjoin('countries','cities.country_id','countries.id')
                        ->select('cities.*','countries.id as countryy_id','countries.name as country_id');
        $url = url('/');  
        return DataTables::of($stateList)   
                          ->addIndexColumn()
                          ->addColumn('status', function ($row) {
                            return '<div class="status_button_toggle" ral="'.$row->id.'" rel="'.$row->status.'" id="status_button_'.$row->id.'"></div>';
                          })

                        ->addColumn('action', function($row) use($url){
                            return '<a href="javascript:void(0)" class="edit_course" ral_city_id="'.$row->id.'" ral_city_name="'.$row->name.'" state_id="'.$row->stat_id.'" country_id="'.$row->countryy_id.'" data-toggle="modal" data-target="#editCityModal"><i class="fa fa-edit" title="Edit"></i></a>

                            <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($row->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                           })   

                          ->escapeColumns([])
                          ->make(true);           


    }

    public function changeStatus(Request $request){

        if($request->status && $request->id){
            $statusChanged = City::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function addCity(Request $request){
        $payload = $request->except('_token');
        // dd($payload);
        City::create($payload);
        Session::flash('success', 'New city is added successfully');   

        return redirect()->back();
    }

    public function updateCity(Request $request){
        $payload = $request->except('_token');
        // dd($payload);
        $courseData = City::where('id',$request->input('id'))->first();
        // dd($courseData);
        $courseData->update($payload);
        Session::flash('success', 'City is updated successfully');   
        return redirect()->back();   
    }

    public function deleteCity($id, Request $request)
    {   
        $data= City::where('id', base64_decode($id))->first();
        if(!empty($data)){
          $dataDeleted = City::where('id', base64_decode($id))->first()->delete();
          // Session::flash('success','City is deleted successfully');
          return $response = array('status'=>'ok');
        }
    }
    public function changeCountry(Request $request){
        $input   = $request->all();
        $states  = State::where('country_id',$input['country_id'])->get();
        $view    = view('admin.element.country',['states' => $states])->render();
        return $view;
   }

   public function changeState(Request $request){
        $input      = $request->all();
        $States     = State::where('country_id',$input['cntrry_id'])->get();
        // dd($States);
        $statesId   = State::where('id',$input['state_id'])->first();
        $view    = view('admin.element.state',compact('States','statesId'))->render();
        return $view;
   }

     public function validateCityName(){

    $name = $_GET['name'];
    $nameCount = City::where('name',$name)->count();

    if ($nameCount >0) {
        $resp = 'false';
    }else{
        $resp = 'true';
    }
       return $resp;
    }


    public function validateEditCityName( Request $request){
        $data = $request->all();       
        $name = @$data['name'];
        
        if ($data['id'] == null) {
            
            $count = City::where('name',$name)->count();;
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = City::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }
    
}
