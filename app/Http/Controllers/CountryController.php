<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use App\Country;
use DataTables;

class CountryController extends Controller
{

    public function countryList(Request $request){
        // $countryList =Country::select('*')->get();
        // dd($countryList);
        $page = 'countries';
        return view('admin.generalManagement.country.countryList',compact('page'));
    }

    public function countryListIndex(Request $request){
        $url = url('/');
        $countryList =Country::select('countries.*');

        return DataTables::of($countryList)
                        ->addIndexColumn()

                       ->addColumn('status', function ($row) {
                            return '<div class="status_button_toggle" ral="'.$row->id.'" rel="'.$row->status.'" id="status_button_'.$row->id.'"></div>';
                          })

                        ->addColumn('action', function($row) use($url){
                            return '<a href="javascript:void(0)" class="edit_course" ral_country_id="'.$row->id.'" ral_country_name="'.$row->name.'" data-toggle="modal" data-target="#editCountryModal"><i class="fa fa-edit" title="Edit"></i></a>
                                
                                <a href="javascript:void(0)" class="del_btn" val="'.base64_encode($row->id).'"><i class="fa fa-trash" title="Delete"></i><a>';
                           })   

                          ->escapeColumns([])
                          ->make(true);

                          // "'.url('admin/generalManagement/countries/delete').'/'.base64_encode($row->id).'"
    }


    public function changeStatus(Request $request)
    {
        if($request->status && $request->id){
            $statusChanged = Country::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

    public function addCountry(Request $request){
        // dd($payload);
        $payload = $request->except('_token');
        Country::create($payload);
        Session::flash('success', 'New country is added successfully');   

        return redirect()->back();
    }

    public function updateCountry(Request $request){
        $payload = $request->except('_token','name');
         // dd($payload);
        $courseData = Country::where('id',$request->input('id'))->first();
        $courseData->update($payload);
        Session::flash('success', 'Country is updated successfully');   
        return redirect()->back();   
    }

    public function deleteCountry($id, Request $request)
    {   
        $data= Country::where('id', base64_decode($id))->first();
        if(!empty($data)){
          $dataDeleted = Country::where('id', base64_decode($id))->first()->delete();
          // Session::flash('success','Country is deleted successfully');
          return $response = array('status'=>'ok');
        }
    }

    public function validateCountryName(){

    $name = $_GET['name'];
    $nameCount = Country::where('name',$name)->count();

    if ($nameCount >0) {
        $resp = 'false';
    }else{
        $resp = 'true';
    }
       return $resp;
    }


    public function validateEditCountryName( Request $request){

        $data = $request->all();
        $name = @$data['name'];
        
        if ($data['id'] == null) {
            
            $count = Country::where('name',$name)->count();;
            // dd($count);        
            
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        } else{

            $id    = $data['id'];
            $count = Country::where('name',$name)->where('id','!=',$id)->count();
            // dd($count);  
            if ($count > 0) {
                return 'false';
            } else {
                return 'true';
            }
        }
   }

}