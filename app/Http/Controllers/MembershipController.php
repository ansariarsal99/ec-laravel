<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use DataTables;
use App\Membership;
use App\MembershipLevel;


class MembershipController extends Controller
{

	public function membershipContent(Request $request){

        try{
        if($request->isMethod('post')){
            $input = $request->all();
             // dd($input);
            $update = Membership::first();   

            if(!empty($update)){
                $update->title         = $request->title;
                $update->description   = $request->description;

                 if ($update->save()){             
                      return redirect()->back()->with('success','Membership content updated sucessfully');
                 }else{
                    Session::flash('error','Something went wrong');
                    return redirect()->back();
                  }

               }
            }   

            $terms_condition = Membership::orderby('created_at', 'desc')->first();
            $page = 'membership'; 

        return view('admin.membership.membershipContent', compact('page','terms_condition'));
       } catch (Exception $e) {
            \Log::error($e->getMessage());
            Session::flash('error', 'Oops, Something went wrong');
            return redirect()->back();
        }
   }
    public function membershipList(Request $request)
    {    
      $page =  'membership-level';
      return view('admin.membership.membershipLevel.membershipLevelList',compact('page'));
    }

   public function membershipListIndex(Request $request) 
   {
      $membershipList = MembershipLevel::select('memberships_levels.*')
                                           ->orderBy('id', 'ASC')
                                           ->get();

       return DataTables::of($membershipList)
              ->addIndexColumn()

              ->addColumn('status', function ($membershipList) {
                  return '<div class="status_button_toggle" ral="' . $membershipList->id . '" rel="' . $membershipList->status . '" id="status_button_' . $membershipList->id . '"></div>';
              })

              ->addColumn('action', function ($membershipList) {
                  return 
                  '<a href="' . url("admin/membership/edit/".base64_encode($membershipList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>';
              })
              ->escapeColumns([])
              ->make(true);    

               // <a href="' . url("admin/membership/delete/" . base64_encode($membershipList->id)) . '" class="del-btn"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';                            
   } 

    public function changeStatusMembershipLevel(Request $request){

        if($request->status && $request->id){
            $statusChanged = MembershipLevel::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
    }

   public function addMembership(Request $request)
    {
      if($request->isMethod('post')) {
          $payload = $request->except('_token');
          MembershipLevel::create($payload);
          Session::flash('success', 'New membership is added successfully');
          return redirect('admin/membership/list'); 
     }
      $page =  'membership-level';
      return view('admin.membership.membershipLevel.addMembershipLevel',compact('page'));
    }

   public function editMembership(Request $request,$id)
    {
      $id              = base64_decode($id);
      $membershipLevel = MembershipLevel::where('id',$id)->first();

      if($request->isMethod('post')) {
          $payload = $request->except('_token');
          $membershipLevel = MembershipLevel::where('id',$request->input('id'))->first();
          // dd($membershipLevel);
          $membershipLevel->update($payload);
          // MembershipLevel::update($payload);
          Session::flash('success', 'membership is updated successfully');
          return redirect('admin/membership/list'); 
     }
      $page =  'membership-level';
      return view('admin.membership.membershipLevel.editMembershipLevel',compact('page','membershipLevel'));
    }

   public function deleteMembership($id, Request $request)
     {
        $id               = base64_decode($id);
        $membershipLevel     = MembershipLevel::where('id',$id)->first(); 
        $membershipLevelId   = $membershipLevel->id;
        // dd($subscriptionId);
        if(!empty($id)) {
          // $data->delete();
        $data = MembershipLevel::where('id',$membershipLevelId)->delete(); 
           Session::flash('success', 'MembershipLevel deleted successfully');
           return redirect()->back();
          }else {
            Session::flash('error', 'Something went wrong');
             return redirect()->back();
          } 
      }

}
