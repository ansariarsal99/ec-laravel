<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests, DB, Session, Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Auth;
use Crypt;
use Config;
use DataTables;
use App\Admin;
use App\ProductTax;

class AdminController extends Controller
{

  public function login(Request $request)
  {


      if (!Auth::guard('admin')->check()) {

        if ($request->isMethod('post')) {

            $data = $request->all();
//                  dd($data);
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                Admin::where('id',Auth::guard('admin')->user()->id)->update(['is_login'=>'yes']);
                session::flash('success', 'Welcome to Mawad Mart' . Auth::guard('admin')->user()->name);
                return redirect('admin/dashboard');
            } else {
                session::flash('error', "Credentials didn't matched, Please Try Again.");
                return redirect('admin');
            }
        }
     }else {
        return redirect('admin/dashboard');
      }
        return view('admin.login');
    }


    public function dashboard(Request $request)
    {
      $page='dashboard';
      return view('admin.dashboardNew',compact('page'));

    }

    public function logout()
    {
      // session::flash('success', "Logout Successfully.");
        Admin::where('id',Auth::guard('admin')->user()->id)->update(['is_login'=>'no']);
        Auth::guard('admin')->logout();
        return redirect('admin')->with(session::flash('success', "Logout Successfully."));
    }

    public function profile(Request $request){
     if($request->isMethod('post')){
          $data = $request->all();
           $data = $request->except('_token');
            $auth_id = Auth::guard('admin')->user()['id'];
            Admin::where('id',$auth_id)->update($data);
            Session::flash('success', 'profile updated successfully');
            return redirect()->back();
        }

        $admin = Admin::first();
        $admin = !empty($admin) ? $admin->toArray() : [];
        $page='';
        return view('admin.profile',compact('admin','page'));
    }

    public function profileImage(Request $request){
      if($request->isMethod('post')){
          $data = $request->all();
           if(isset($data['uploader']) && !empty($data['uploader'])){
                $image = $request->file('uploader');

                $data['uploader'] = time().'_'.rand().'.'.$image->getClientOriginalExtension();
                $destination_path = adminProfileImageBasePath;
                $image->move($destination_path,$data['uploader']);
                $auth_id = Auth::guard('admin')->user()['id'];
                $prev_img = Admin::where('id',$auth_id)->value('image');

                if (!empty($prev_img) && file_exists(adminProfileImageBasePath.'/'.$prev_img)) {
                    $unlink_img = unlink(adminProfileImageBasePath.$prev_img);
                }
                 $admin = Admin::first();
                 Admin::first()->update(['image'=>$data['uploader']]);
            }
      }
       return 'true';
    }
      // public function forgotPassword(Request $request){

      //   $data = $request->all();
      //   $data = $request->input();
      //   if (!empty($data)) {
      //       $exist = Admin::where('email',$data['email'])->first();

      //       if(!empty($exist)){
      //           $rand        = rand(1,900).str_random(8).rand(1,900).'1';
      //           $id          = $exist->id;
      //           $email       = $exist->email;

      //           $password = '';
      //           $links = array();
      //           $links['first_name']   = ucfirst($exist->first_name);
      //           $links['last_name']    = $exist->last_name;
      //           $links['password']     = $rand;
      //           $links['phone_no']     = $exist->phone_no;
      //           $links['email']        = $exist->email;
      //           // $links['image'] = defaultAdminImagePath.'logo.png';
      //           // dd($links['phone_no']);
      //               // dd('hello');
      //           $subject = PROJECT_NAME." Forgot Password";

      //           Mail::send('admin.email.Forgot', $links, function($message) use ($email,$subject){
      //               $message->to($email)->subject($subject);
      //           });

      //           Admin::where('id',$exist->id)->update(['password'=>Hash::make($rand)]);
      //           session::flash('success', "A link is sent on your registered email id to reset the password.");
      //           return redirect('admin');
      //       }else {
      //         Session::flash('error', 'Email does not exist.');
      //         return redirect()->back();
      //        }
      //   }
      // return view('admin.forgetPassword');
      // }

    public function forgotPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->email != "" && $request->email != null){
                $user_check = Admin::where(['email' => $request->email])->first();
                if($user_check != null)
                {
                 $email    = $request->email;
                 $adminData = Admin::where(['email' => $request->email])->first();
                 $new_id    = $adminData->first()->id;
                 $new_name  = $adminData->first()->first_name;
                 $last_name  = $adminData->first()->last_name;
                 // dd($new_name);
                 $email = $request->email;
                 // $links['url']=url('admin/passwordReset');
                 $links['url'] = url('admin/passwordReset');
                 $links['email'] = $email;
                 $links['new_id'] = $new_id;
                 $links['new_name'] = $new_name;
                 $links['last_name'] = $last_name;



                 $links['phone_no']     = $adminData->phone_no;
                 $links['email']        = $adminData->email;
                 $subject = PROJECT_NAME." Forgot Password";
                 Mail::send('admin.email.Forgot', $links, function ($message) use ($email, $subject) {
                     $mail = $message->to($email)->subject($subject);
                 });
                 session::flash('success', "A link is sent on your registered email Id.");
                 return redirect('admin');
             }
             else
             {
                Session::flash('error', 'Email does not exist.');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Something went wrong. Please try again.');
            return redirect()->back();
        }
    }

    return view('admin.forgetPassword');
    }



    public function getResetPassword(Request $request)
    {
     Session::flash('success', 'Welcome,Please change your password');
     if ($request->isMethod('post')) {

        $data = $request->all();
        $admin_data = Admin::first();

        if (isset($data['new_password']) && !empty($data['new_password'])) {
            $encrypt_password = Hash::make($data['new_password']);
            $update = Admin::where(['id' => $admin_data['id']])->update(['password' => $encrypt_password]);
            Session::flash('success', 'Password updated successfully');
            return redirect('admin');
        }
    }

    return view('admin.reset');
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (isset($data['old_password']) && !empty($data['old_password'])) {
                $admin_data = Admin::first();
                if (Hash::check($data['old_password'], $admin_data['password'])) {
                    if (empty($admin_data) || $admin_data == null) {
                        Session::flash('error', 'Old password did not match');
                        Session::put('wrong_pwd', 'wrong_pwd');
                        return redirect()->back();
                    } else {
                        if (isset($data['new_password']) && !empty($data['new_password'])) {
                            $encrypt_password = Hash::make($data['new_password']);
                                //  dd($encrypt_password);
                            $update = Admin::where(['id' => $admin_data['id']])->update(['password' => $encrypt_password]);
                            Session::flash('success', 'Password updated successfully');
                            return redirect()->back();
                        }
                    }
                } else {
                    Session::flash('error', 'Old password did not match');
                    Session::put('wrong_pwd', 'wrong_pwd');
                    return redirect()->back();
                }
            } else {
                Session::flash('error', 'Old password did not match');
                Session::put('wrong_pwd', 'wrong_pwd');
                return redirect()->back();
            }
        }
      return redirect('admin/profile/changePassword');
    }

    public function addProductTax(Request $request){

      if ($request->isMethod('post')) {
          $data = $request->all();
          $data = $request->except('_token');
          // dd($data);
          ProductTax::where('id',$data['tax_id'])->update(['tax_percent'=>$data['tax_percent']]);
          Session::flash('success','Tax percent updated successfully');
        }
      $productTax = ProductTax::first();
      $page = 'tax';
      return view('admin.productTax.tax',compact('productTax','page'));

    }

}




    // public function insert(Request $request)
    // {
    //     $input = $request->input();
    //     Admin::create([
    //     	'type'=>'admin',
    //         'first_name'=>'deepak',
    //         'last_name'=>'kamboj',
    //         'email'=>'muwad@mailinator.com',
    //         'phone_no'=>'3321645478',
    //         'password'=>Hash::make('123456'),
    //         'status'=>'active'
    //

    //     ]);

    // }
