<?php

namespace App\Http\Controllers;

// use DB;
use Illuminate\Support\Facades\DB;
use App\Appointment;
use App\Patient;
use App\Message;
use App\Demography;
use DateTime;
use Session;

use Illuminate\Http\Request;

class UnavailabilityController extends Controller
{
    public function index() {

        return view('unavailability.index');
    }
    public function store(Request $request) {
        $a = date_create_from_format("m/d/Y H:i a",$request->unavailableFrom);
        $unavailableFrom = $a->format('Y-m-d H:i:s');
        $b = date_create_from_format("m/d/Y H:i a",$request->unavailableTo);
        $unavailableTo2 = $b->format('Y-m-d H:i:s');
        $unavailableTo2 = strtotime($unavailableTo2);    
        $unavailableTo = date("Y-m-d H:i:s", strtotime("+23 hours 59 minutes", $unavailableTo2));
        // dd($unavailableFrom, $unavailableTo);
        $patients = DB::table('appointments')
                        ->leftJoin('patients', 'appointments.patients_id', '=', 'patients.id')
                        ->where('confirmed', '=', 1)
                        ->whereBetween('appointment_at', [$unavailableFrom, $unavailableTo])
                        ->select('appointments.*', 'patients.mobile as mobile', 'patients.id as pid')
                        ->get();
        // dd($patients, $unavailableFrom, $request->unavailableFrom, $unavailableTo, $request->unavailableTo);
        foreach ($patients as $patient) {
            // var_dump($patient->mobile, $request->unavailabilityMsg, $patient->pid, 'Greetings');
            $this->send_sms($patient->mobile, $request->unavailabilityMsg, $patient->pid, 'Unavailability', $patient->id);
        } 
        Session::flash('message', 'Message Sent Successfully!');
        return view('unavailability.index');
    }

    public function send_sms($to, $message, $patients_id, $for, $appId){
        $token = "cb3301ba6e2d64b4f215d168cf48a0eb";
        $url = "http://api.greenweb.com.bd/api.php?json";

        $sms = new Message();
        $sms->patients_id = $patients_id;
        $sms->for = $for;
        $sms->text = $message;

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
            $app2 = Appointment::find($appId);
            $app2->confirmed = false;
            $app2->unavailability_sms_sent = true;
            $app2->save();
        } else {
            $sms->status = 'Failed';
        }
        $sms->save();
    }
}
