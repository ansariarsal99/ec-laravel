<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use App\Http\Controllers\Controller;
use Exception;
use DataTables;
use App\Subscription;

class SubscriptionController extends Controller
{
    public function subscriptionList(Request $request)
    {
      try{
	   	$page="subscription";
	   	return view('admin.subscriptionManagenment.list',compact('page'));
       } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

   public function subscriptionListIndex(Request $request) 
   {
       $subscriptionList = Subscription::select('*');
       // $url = url('/');
       return DataTables::of($subscriptionList)
              ->addIndexColumn()

              ->addColumn('status', function ($subscriptionList) {
                  return '<div class="status_button_toggle" ral="' . $subscriptionList->id . '" rel="' . $subscriptionList->status . '" id="status_button_' . $subscriptionList->id . '"></div>';
              })

               ->addColumn('action', function ($subscriptionList) {
                  return 
                  '<a href="' . url("admin/subscriptionManagement/editSubscription/".base64_encode($subscriptionList->id)) . '" class="edit-btn"> <i class="fa fa-pencil" title="Edit"></i></a>
                  <a href="' . url("admin/subscriptionManagement/deleteSubscription/" . base64_encode($subscriptionList->id)) . '" class="del-btn"  onclick="return confirm(\'Are you sure you want to delete?\')"> <i class="fa fa-trash" title="Delete"></i></a>';
                })

              ->escapeColumns([])
	            ->make(true);                                
   }

    public function addSubscription(Request $request){
      try{
        if($request->isMethod('post')) {
          $payload = $request->except('_token');
          Subscription::create($payload);
          Session::flash('success', 'New subscription is added successfully');
          return redirect('admin/subscriptionManagement/subscribeList'); 
      }
        $page="subscription";
        return view('admin.subscriptionManagenment.addSubscription',compact('page'));
         } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function updateSubscription(Request $request,$id){
      try{
        if($request->isMethod('post')) {
            $payload = $request->except('_token');
            // dd($payload);
            $Subscription = Subscription::where('id',$request->input('id'))->first();
            // dd($Subscription);
            $Subscription->update($payload);
            Session::flash('success', 'Subscription is updated successfully');
            return redirect('admin/subscriptionManagement/subscribeList'); 
       }

        $id   = base64_decode($id);
        $subscribe = Subscription::where('id',$id)->first();
        // dd($subscribe);
        $page="subscription";
        return view('admin.subscriptionManagenment.editSubscription',compact('page','subscribe'));
         } catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }

    public function deleteSubscription($id, Request $request)
     {
        $id               = base64_decode($id);
        $subscription     = Subscription::where('id',$id)->first(); 
        $subscriptionId   = $subscription->id;
        // dd($subscriptionId);
        if(!empty($id)) {
          // $data->delete();
        $data = Subscription::where('id',$subscriptionId)->delete(); 
           Session::flash('success', 'Subscription deleted successfully');
           return redirect()->back();
          }else {
            Session::flash('error', 'Something went wrong');
             return redirect()->back();
          } 
      }



    public function changeStatus(Request $request)
    {
      try{
        if($request->status && $request->id){
            $statusChanged = Subscription::where(['id' => $request->id])->update(['status' => $request->status]);
            return ['status' => 'success', 'message' => 'Status changed successfully'];
        }else{
            return ['status' => 'error', 'message' => 'Some required details is missing'];
        }
      }catch (Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error', trans('messages.admin.common_error'));
            return redirect()->back();
        }
    }
                  
              
 
}
