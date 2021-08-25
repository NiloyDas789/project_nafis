<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use Illuminate\Support\Facades\DB;
use App\Appointment;
use App\Patient;
use App\Message;
use App\Demography;
use DateTime;

class CronController extends Controller
{
    public function index() {
        // $d=strtotime(now());
        // $date = date("Y-d-m H:i:s", $d);//now();
        $date = date("Y-m-d H:i:s");
        // $new_date = date("Y-d-m H:i:s", strtotime('+5 hours', strtotime($date)));
        $new_date = date("Y-m-d H:i:s", strtotime("+5 hours"));

        $appointments = DB::table('appointments')
                        ->leftJoin('patients', 'appointments.patients_id', '=', 'patients.id')
                        ->whereBetween('appointment_at', [$date, $new_date])
                        ->where('confirmed', '=', 1)
                        ->where('reminder_sms_sent', '=', 0)
                        ->select('appointments.*', 'patients.name as name', 'patients.mobile as mobile')
                        ->get();
        // dd($appointments);
        foreach ($appointments as $appointment) {
            $timex = date("Y-d-m H:i:s A", strtotime($appointment->appointment_at));
            $app_date = date("d-m-Y", strtotime($appointment->appointment_at));
            $app_time = date("h:i A", strtotime($appointment->appointment_at));
            
            $reminder_message =
'Dear '.$appointment->name.', 
*Reminder* : You have an  appointment with Dr. SM Bakhtiar Kamal on '.$app_date.' at '.$app_time.' has been created. 
- Kamal Hair & Skin Center';
            // dd($reminder_message);
            $this->send_sms($appointment->mobile, $reminder_message, $appointment->patients_id, 'Reminder', $appointment->id);
        }
        // exit();
    }
    public function send_sms($to, $message, $patients_id, $for, $ap_id){
        $token = "cb3301ba6e2d64b4f215d168cf48a0eb";
        $url = "http://api.greenweb.com.bd/api.php?json";

        $sms = new Message();
        $sms->patients_id = $patients_id;
        $sms->for = $for;
        $sms->text = $message;

        $app = Appointment::find($ap_id);

        $data= array(
            'to'=>"$to",
            'message'=>"$message",
            'token'=>"$token"
        ); // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        //Result
        $target = '"status": "SENT"';
        if (str_contains($smsresult, $target)) {
            $sms->status = 'Sent';
            $app->reminder_sms_sent = 1;
            $app->save();
        } else {
            $sms->status = 'Failed';
        }
        $sms->save();
    }
}
