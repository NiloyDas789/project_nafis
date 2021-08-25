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

class DemographyController extends Controller
{
    public function index(Request $request) {
        $age_from   = 0;
        $age_to     = 200;

        if (isset($request->inputAgeFrom)) {
            $age_from = $request->inputAgeFrom;
        }
        if (isset($request->inputAgeTo)) {
            $age_to = $request->inputAgeTo;
        }
        $patients = Patient::whereBetween('age', [$age_from, $age_to]);
        if (isset($request->inputGender2)) {
            $gender = $request->inputGender2;
            $patients = $patients->where('gender', '=', $gender);
        }
        if (isset($request->inputTreatmentType)) {
            $treatment_type = $request->inputTreatmentType;
            $patients = $patients->where('treatment_type', '=', $treatment_type);
        }
        if (isset($request->lastAppointment)) {
            $a = date_create_from_format("m/d/Y H:i a",$request->lastAppointment);
            $date = date("Y-m-d H:i:s");
            $last_appointment = $a->format('Y-m-d H:i:s');
            $patients = $patients->where('last_appointment', '>=', $last_appointment)->where('last_appointment', '<=', $date);
            // dd($last_appointment, $date);
        }
        $patients = $patients->latest()->get();
        Session::flash('demography_list', $patients);
        return view('demography.index', ['patients' => $patients]);
    }
    public function send_bulk_sms(Request $request) {
        $patients = Session::get('demography_list');
        foreach ($patients as $patient) {
            $this->send_sms($patient->mobile, $request->inputGreetings, $patient->id, 'Promotion');
        }
        Session::forget('demography_list');
        $patients = Patient::all();
        return view('demography.index', ['patients' => $patients]);
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
