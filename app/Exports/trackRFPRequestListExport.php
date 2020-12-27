<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\RequestForProposalAssignToUser;
use Auth;
use DateTime;

class trackRFPRequestListExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // $countryList =Country::select('countries.*');
        $count = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                         ->where('user_id',Auth::user()->id)
                                                         ->count();
        // dd($count);
        // dd($count - 2000);
        $offset = 0;
        $limit = 1000;
        $arr_to_return = [];

        while($count>=0){

            $quotations = RequestForProposalAssignToUser::whereHas('requestForProposalDetail',function($q){ $q->where('completed_step_no',9)->where('form_status','completed')->where('status','active'); })
                                                     ->where('user_id',Auth::user()->id)
                                                     ->with(['userDetail'=>function($q){ $q->select('id','company_name','contact_name','location','email','isd_code','mobile_no','location','experience','user_property_id'); },'requestForProposalDetail'=>function($q){ $q->select('*'); },'userDetail.userPropertyDetail','userDetail.userSelectedServicesDetail.userServiceDetail','requestForProposalDetail.userDetail'=>function($q){ $q->select('id','first_name','last_name','isd_code','mobile_no','email'); },'requestForProposalDetail.userTypeDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.countryDetail'=>function($q){ $q->select('id','name'); },'requestForProposalDetail.requestForProposalServices.userServiceDetail','requestForProposalAssignToUserStatusDetail','requestForProposalDetail.ProjectCityDetail'])
                                                     ->orderBy('id','desc')
                                                     ->skip($offset)
                                                     ->take($limit)
                                                     ->get()
                                                     ->toArray();

            foreach ($quotations as $key => $quotation) {

                $services = $quotation['request_for_proposal_detail']['request_for_proposal_services'];   
                $service = '';
                foreach ($services as $key1 => $value) {
                    if ($key1==0) {
                        $sep = "";
                    }else{
                        $sep = ",";
                    }
                    $service = $service.$sep.$value['user_service_detail']['name'];
                }
                // dd($quotation);
                $datetime = new DateTime();
                $ReqDate = new DateTime($quotation['request_for_proposal_detail']['created_at']);
                $ReqSubDate = new DateTime($quotation['request_for_proposal_detail']['proposal_submission_deadline_date']);
                $ReqDateInterval = $datetime->diff($ReqDate);
                $ReqDatedays = $ReqDateInterval->format('%a');//now do whatever you like with $days
                $ReqSubDateInterval = $datetime->diff($ReqSubDate);
                $ReqSubDatedays = $ReqSubDateInterval->format('%a');//now do whatever you like with $days
                // dd($datetime);
                if ($ReqSubDate>$datetime || $ReqSubDatedays==0) {
                    $ReqSubDatedays = $ReqSubDatedays;
                }else{
                    $ReqSubDatedays = "--";
                }

                $arr_to_return[] = [
                'Sr. No.'               => $key+1,
                'Request Title'         => @$quotation['request_for_proposal_detail']['request_title'],
                'RFQ ID'                => @$quotation['project_request_no'],
                'Type of Services'      => $service,
                'Status'                => $quotation['request_for_proposal_assign_to_user_status_detail']['name'],
                'Date of Invitation'    => date('d/m/Y', strtotime($quotation['request_for_proposal_detail']['created_at'])),
                'Days Since Invitation' => @$ReqDatedays,
                'Quotation Submision Deadline' => date('d/m/Y', strtotime($quotation['request_for_proposal_detail']['proposal_submission_deadline_date'])),
                'Remaining Days'        => @$ReqSubDatedays,
                'Contact Name(Client)'  => ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['first_name']).' '.ucfirst(@$quotation['request_for_proposal_detail']['user_detail']['last_name']),
                'Contact Number(Client)'=> @$quotation['request_for_proposal_detail']['user_detail']['isd_code'].' '.@$quotation['request_for_proposal_detail']['user_detail']['mobile_no'],
                'Email(Client)'         => @$quotation['request_for_proposal_detail']['user_detail']['email'],
                'Project Name'          => @$quotation['request_for_proposal_detail']['project_name'],
                'Project No.'           => @$quotation['request_for_proposal_detail']['project_no'],
                'Project Location'      => @$quotation['request_for_proposal_detail']['project_address'].', '.@$quotation['request_for_proposal_detail']['project_city_detail']['name'].', '.@$quotation['request_for_proposal_detail']['country_detail']['name'],
                ];
            }

            $offset = $offset + $limit;
            $count = $count - $limit; 
        }

        return collect($arr_to_return);
    }

    public function headings(): array
    {
        return [
            'Sr. No.',
            'Request Title',
            'RFQ ID',
            'Type of Services',
            'Status',
            'Date of Invitation',
            'Days Since Invitation',
            'Quotation Submision Deadline',
            'Remaining Days',
            'Contact Name(Client)',
            'Contact Number(Client)',
            'Email(Client)',
            'Project Name',
            'Project No.',
            'Project Location',
        ];          

    }
}
