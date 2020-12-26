<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mail;
use App\Notification;
use App\GcmDevice;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendMail($template_name, $to, $data, $attach = null) {

        $mail_content = [];
        $mail_content = $data;

        $msg    =['data'=>$mail_content];

        if($template_name == 'userRegistrationSuccess'){

            $subject = PROJECT_NAME.' - Registration Successful';

        }else if($template_name == 'forgotPassword'){

            $subject = PROJECT_NAME.' - Forgot Password';

        }else if($template_name == 'requestForProposalDeleteByUser'){

            $subject = PROJECT_NAME.' - Request For Proposal Removed';

        }else if($template_name == 'requestForProposalRejectByUser'){

            $subject = PROJECT_NAME.' - Request For Proposal Rejected';

        }else if($template_name == 'requestForProposalStatus'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposal'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposalCancelled'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposalSubmissionDeadlineChanged'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposalAssignToUserCancelled'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposalAssignToUserRejected'){

            $subject = PROJECT_NAME.' - '.$data['subject'];

        }else if($template_name == 'requestForProposalAssignToUserAccepted'){

            $subject = PROJECT_NAME.' - '.$data['subject'];
        }
        // dd('1');

        Mail::send('frontend/emails.'.$template_name,$msg,function($msg) use ($to,$subject,$template_name,$attach){
            $msg->to($to)->subject($subject);

            // if($template_name == 'newsletter'){
            //     $msg->attach(newsletterDocumentBasePath.'/'.$attach);
            // }
        }); 
    }

    public function sendNotification($notificationId) {

        $notificationData = Notification::where('id',$notificationId)->with(['senderDetail'=>function($q){ $q->select('id','user_type_id','first_name','last_name','contact_name'); }])->first();
        $notificationData = !empty($notificationData) ? $notificationData->toArray() : [];
        // dd($notificationData);
        if ($notificationData['sender_detail']['user_type_id']==1 || $notificationData['sender_detail']['user_type_id']==2) {
            $senderName = ucfirst($notificationData['sender_detail']['first_name']).' '.ucfirst($notificationData['sender_detail']['last_name']);
        }else{
            $senderName = ucfirst($notificationData['sender_detail']['contact_name']);
        }

        if ($notificationData['type']=="rfp_sent") {
            $title = $senderName." sent you Request For Proposal";
        }
        // dd($senderName);
        $tokens = GcmDevice::where('user_id',$notificationData['receiver_id'])->pluck('device_token')->toArray();
        // $tokens = GcmDevice::where('user_id',23)->pluck('device_token')->toArray();
        // dd($tokens);
        if (sizeof($tokens)>0) {
            foreach ($tokens as $key => $token) {
                if (!empty($token)) {
                    $to = $token;  
                    $from = notificationServerKey;
                    $msg = array
                          (
                            'body'  => "Mawad Mart",
                            'title' => $title,
                            'receiver' => 'erw',
                            'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                            'sound' => 'mySound'/*Default sound*/
                          );

                    $fields = array
                            (
                                'to'        => $to,
                                'notification'  => $msg
                            );

                    $headers = array
                            (
                                'Authorization: key=' . $from,
                                'Content-Type: application/json'
                            );
                    // dd($fields);
                    //#Send Reponse To FireBase Server 
                    $ch = curl_init();
                    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                    curl_setopt( $ch,CURLOPT_POST, true );
                    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                    $result = curl_exec($ch );
                    // dd($result);
                    curl_close( $ch );
                }
            }
        }        
    }
}
