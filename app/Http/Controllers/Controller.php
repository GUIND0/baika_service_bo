<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
   use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function _sendNewMail(string $object, string $message, array $recipients){
        $maildata = [
                'object' => $object,
                'message' => $message
        ];
        foreach ($recipients as $recipient) {
            Mail::to($recipient)->queue(new SendMail($maildata));
        }
    }

    public function _sendNewSMS(string $message, array $receivers){

        $endpoint = 'ovh-eu';
        $applicationKey = 'aZ0I7GEMguvU6034';
        $applicationSecret = 'gyebdhYxkaotDpGeK4k1akSYH6sWAubh';
        $consumerKey = 'JsKOlfpWgI8w2Q2ZW9HUoqmoNT7syqfK';

        $conn = new Api(    $applicationKey,
                            $applicationSecret,
                            $endpoint,
                            $consumerKey);

        $smsServices = $conn->get('/sms/');

        $content = (object) array(
            "charset"=> "UTF-8",
            "class"=> "phoneDisplay",
            "coding"=> "7bit",
            "message"=> $message,
            "noStopClause"=> false,
            "priority"=> "high",
            "receivers"=> $receivers,
            "senderForResponse"=> false,
            "sender"=> "DNTML.NET",
            "validityPeriod"=> 2880
        );
        $resultPostJob = $conn->post('/sms/'. $smsServices[1] . '/jobs', $content);
        if($resultPostJob){
            return true;
        }
        return false;

    }
}
