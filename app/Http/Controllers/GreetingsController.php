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
use Session;

class GreetingsController extends Controller
{
    public function index() {

        return view('greetings.index');
    }
    public function store(Request $request) {
        // dd($request->inputGreetings);
        //$this->send_greetings($request->inputGreetings);
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $this->send_sms($patient->mobile, $request->inputGreetings, $patient->id, 'Greetings');
        }
        Session::flash('message', 'Message Sent Successfully!');
        return view('greetings.index');
    }

    public function send_sms($to, $message, $patients_id, $for){
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
        } else {
            $sms->status = 'Failed';
        }
        $sms->save();
    }
}
