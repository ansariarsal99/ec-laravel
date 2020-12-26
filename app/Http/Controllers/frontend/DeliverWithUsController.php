<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request, Session;
use App\User;
use Auth;
use Hash;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use App\Country;
use App\UserType;
use App\UserVehicle;

class DeliverWithUsController extends Controller
{
    //
    public function deliverWithUs(Request $request) {

        try{
            $data = $request->all();   
            $countries = Country::orderBy('name','asc')->where('status','active')->select('id','name','status')->get()->toArray();      
            // dd($countries);
            $page = 'deliverWithUs';
            return view('frontend.home.deliverWithUs',compact('page','countries'));
        }catch(Exception $e){
            \Log::error($e->getMessage());
            Session::flash('error',trans('messages.frontend.common_error'));
            return redirect()->back();
        }
    }

    public function deliverWithUsRegistration(Request $request) {

        $data = $request->all();
        // dd($data);
        if (!empty($data)) {
            
            if (isset($data['deliver_id']) && !empty($data['deliver_id'])) {

                $profileImage = User::where('id',base64_decode($data['deliver_id']))->value('profile_image');

                if(isset($data['profile_image']) && !empty($data['profile_image'])){
                    // dd($data);
                    $image = $request->file('profile_image');
                    $ext = strtolower($image->getClientOriginalExtension());
                    $data['profile_image'] = time().'_'.rand().'.'.$ext;

                    $destination_path = userProfileImageBasePath;

                    if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                        $image = Image::make($request->file('profile_image'));
                        $image = $image->resize(600,null,function($constraint){
                              $constraint->aspectRatio();
                              $constraint->upsize();
                          });

                        $image->save($destination_path.'/'.$data['profile_image']);

                        if($profileImage != null && file_exists(userProfileImageBasePath.'/'.$profileImage) ) {
                            unlink(userProfileImageBasePath.'/'.$profileImage);
                        }

                    }else{
                        return array('status'=>'error');                    
                    }
                  
                }else{
                    $data['profile_image'] = $profileImage;
                } 

                $update = User::where('id',base64_decode($data['deliver_id']))
                               ->update([
                                        // 'user_type_id'=>$userTypeId,
                                        // 'user_id'=>Auth::user()->id,
                                        // 'supplier_code'=>$userNo,
                                        'company_name'=>$data['company_name'],
                                        'contact_name'=>$data['contact_name'],
                                        'contact_last_name'=>$data['contact_last_name'],
                                        'mobile_no'=>$data['mobile_no'],
                                        'isd_code'=>'+'.$data['isd_code'],
                                        'email'=>$data['email'],
                                        'password'=>$data['password'],
                                        'cr_number'=>$data['cr_number'],
                                        'website_url'=>$data['website_url'],
                                        'additional_information'=>$data['additional_information'],
                                        'address_line_1'=>$data['address_line_1'],
                                        'address_line_2'=>$data['address_line_2'],
                                        'landline'=>$data['landline'],
                                        'landline_isd_code'=>'+'.$data['landline_isd_code'],
                                        'country_id'=>$data['country_id'],
                                        'city_id'=>$data['city_id'],
                                        'profile_image'=>$data['profile_image'],
                                        ]);
                $userId = base64_decode($data['deliver_id']);       
            }else{
                $userTypeId = UserType::where('alias','delivery_person')->value('id');
                $userCount = User::where('user_type_id',$userTypeId)->count();
                $userNo = 'BM-DELIVERY-PERSON-'.sprintf("%06d", $userCount+1);
                $data['password'] = Hash::make($data['password']);

                if(isset($data['profile_image']) && !empty($data['profile_image'])){
                    // dd($data);
                    $image = $request->file('profile_image');
                    $ext = strtolower($image->getClientOriginalExtension());
                    $data['profile_image'] = time().'_'.rand().'.'.$ext;

                    $destination_path = userProfileImageBasePath;

                    if($ext == 'jpg' || $ext == 'jpeg'|| $ext == 'png'|| $ext == 'gif' || $ext == 'bmp'){
                        $image = Image::make($request->file('profile_image'));
                        $image = $image->resize(600,null,function($constraint){
                              $constraint->aspectRatio();
                              $constraint->upsize();
                          });

                        $image->save($destination_path.'/'.$data['profile_image']);

                    }else{
                        return array('status'=>'error');                    
                    }
                  
                }else{
                    $data['profile_image'] = null;
                } 

                $userId = User::create([
                                        'user_type_id'=>$userTypeId,
                                        // 'user_id'=>Auth::user()->id,
                                        'supplier_code'=>$userNo,
                                        'company_name'=>$data['company_name'],
                                        'contact_name'=>$data['contact_name'],
                                        'contact_last_name'=>$data['contact_last_name'],
                                        'mobile_no'=>$data['mobile_no'],
                                        'isd_code'=>'+'.$data['isd_code'],
                                        'email'=>$data['email'],
                                        'password'=>$data['password'],
                                        'cr_number'=>$data['cr_number'],
                                        'website_url'=>$data['website_url'],
                                        'additional_information'=>$data['additional_information'],
                                        'address_line_1'=>$data['address_line_1'],
                                        'address_line_2'=>$data['address_line_2'],
                                        'landline'=>$data['landline'],
                                        'landline_isd_code'=>'+'.$data['landline_isd_code'],
                                        'country_id'=>$data['country_id'],
                                        'city_id'=>$data['city_id'],
                                        'profile_image'=>$data['profile_image'],
                                        ])->id;  
                
            }
            // dd($userId);
            if (!empty($userId) && $userId!=null) {             
                return array('status'=>'success', 'encUserId'=>base64_encode($userId));
            }else{
                return array('status'=>'error');                    
            }
        }else{
            return array('status'=>'error');
        }
    }

    public function deliverWithUsRegistrationAddVehicles(Request $request) {

        $data = $request->all();
        
        if (!empty($data['deliver_id']) && isset($data['vehicle_info']) && sizeof($data['vehicle_info'])>0) {
             
            foreach ($data['vehicle_info'] as $key => $vehicleInfo) {
                
                $filename = null;
                if(isset($vehicleInfo['image']) && !empty($vehicleInfo['image'])) { 
                    $file = $vehicleInfo['image'];                  
                    $extension = strtolower($file->getClientOriginalExtension());
                    $filename =time().rand().'.'.$extension;
                    $file->move(userVehicleImgsBasePath, $filename);
                    $filename = $filename;
                }

                $addVehicle = UserVehicle::create([
                                                   'user_id'=>base64_decode($data['deliver_id']),
                                                   'vehicle_number'=>$vehicleInfo['vehicle_number'],
                                                   'vehicle_name'=>$vehicleInfo['vehicle_name'],
                                                   'vehicle_registration_number'=>$vehicleInfo['vehicle_registration_number'],
                                                   'vehicle_chassis_number'=>$vehicleInfo['vehicle_chassis_number'],
                                                   'image'=>$filename
                                                ]);

                $update = User::where('id',base64_decode($data['deliver_id']))->update(['vehicle_added'=>'yes']);
            }
            // dd($addVehicle);
            return array('status'=>'success');
        }else{
            return array('status'=>'error');
        }
    }
}
