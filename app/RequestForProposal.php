<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestForProposal extends Model
{
    protected $table = "request_for_proposals";

    protected $fillable = ['user_id','user_type_id','completed_step_no','request_no','project_name','project_no','project_address','project_city','project_city_id','project_country_id','request_title','request_description','request_remarks','questions_submission_deadline_date','proposal_submission_deadline_date','proposal_submission_deadline_time','proposal_submission_deadline_date_time','project_site_visitable','client_representative_name','client_representative_isd_code','client_representative_mobile_no','client_representative_email','attach_file','attach_logo','use_profile_photo','save_for_later','request_for_proposal_status_id','form_status','status'];

    public function requestForProposalServices() {

    	return $this->hasMany('App\RequestForProposalService','request_for_proposal_id','id');
    }

    public function userTypeDetail() {

    	return $this->hasOne('App\UserType','id','user_type_id');
    }

    public function countryDetail() {

    	return $this->hasOne('App\Country','id','project_country_id');
    }

    public function projectCityDetail() {

        return $this->hasOne('App\City','id','project_city_id');
    }

    public function requestForProposalStatusDetail() {

        return $this->hasOne('App\RequestForProposalStatus','id','request_for_proposal_status_id');
    }

    public function userDetail() {

        return $this->hasOne('App\User','id','user_id');
    }

    public function requestForProposalServicesDetail() {

        return $this->hasMany('App\RequestForProposalService','request_for_proposal_id','id');
    }


}
