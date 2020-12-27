<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable
{
    use Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $fillable = [ 'name', 'user_type_id','user_id','supplier_code','institution_name','first_name','last_name','email','isd_code','mobile_no','profile_image','gender','date_of_birth','password','reset_password_key','status','otp_verify_status','complete_profile','remember_token','user_property_id','user_service_id','company_name','contact_name','cr_number','website_url','additional_information','address_line_1','address_line_2','landline','landline_isd_code','country_id','city_id','city','location','experience','payment_type','user_subscription_id','transaction_status','expiry_subscription_package','about_me','profile_document','contact_last_name','postal_code','user_other_id','profile_link','certified_provider','is_login','delivery_option_id','vehicle_added','assigned_build_mart_fees','build_mart_fees_type','is_build_mart_fees_approve_by_user','default_amount','default_amount_type','default_amount_build_mart'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userTypeDetail() {

        return $this->hasOne('App\UserType','id','user_type_id');
    }

    public function userPropertyDetail() {

        return $this->hasOne('App\UserProperty','id','user_property_id');
    }

    public function countryDetail() {

        return $this->hasOne('App\Country','id','country_id');
    }

    public function cityDetail() {

        return $this->hasOne('App\City','id','city_id');
    }

    public function userSelectedServicesDetail() {

        return $this->hasMany('App\UserSelectedService','user_id','id');
    }

    public function userSelectedProjectFieldsDetail() {

        return $this->hasMany('App\UserSelectedProjectField','user_id','id');
    }

    public function userProfessionImagesDetail() {

        return $this->hasMany('App\UserProfessionImage','user_id','id');
    }

    public function userSelectedOtherDetail() {

        return $this->hasMany('App\UserOtherService','user_id','id');
    }

    public function UserProfessionPhotos(){

        return $this->hasMany('App\UserProfessionImage','user_id','id');
    }

    public function userDefaultStoreLocation() {

        return $this->hasOne('App\UserStoreLocation','user_id','id')->where('use_address_as_default','yes');
    }

    public function userSelectedprojrctField()
    {
        return $this->hasMany('App\UserSelectedProjectField', 'user_id', 'id');
    }

    public function userVehicles() {

        return $this->hasMany('App\UserVehicle','user_id','id');
    }

    public function userMultipleCategories()
    {
        return $this->hasMany('App\userProductSelectedCategory', 'user_id', 'id');
    }
    public function userMultipleSubCategories()
    {
        return $this->hasMany('App\userProductSelectedSubCategory', 'user_id', 'id');
    }
    public function userMultipleSellingMaterial()
    {
        return $this->hasMany('App\UserProductMaterialList', 'user_id', 'id');
    }

    public function UserbrandPhotos(){

        return $this->hasMany('App\UserBrandImage','user_id','id');
    }

    public function userBuildMartFees(){
         return $this->hasMany('App\UserBuildMartFee','user_id','id');
    }




}
