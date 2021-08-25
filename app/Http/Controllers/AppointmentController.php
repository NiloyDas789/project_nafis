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

class AppointmentController extends Controller
{
    public function index() {
        $patients = Patient::all();
        $appointments = DB::table('appointments')
            ->leftJoin('patients', 'appointments.patients_id', '=', 'patients.id')
            ->select('appointments.*', 'patients.name as name', 'patients.age as age', 'patients.gender as gender', 'patients.mobile as mobile', 'patients.address as address')
            ->latest()
            ->get();
        return view('appointment.index', ['patients' => $patients, 'appointments' => $appointments]);
    }
    public function store(Request $request) {
        $a = date_create_from_format("m/d/Y H:i a",$request->inputAppointmentTime);
        $appointment_at = $a->format('Y-m-d H:i:s');
        
        $app_date = $a->format('d-m-Y');
        $app_time = $a->format('h:i A');
        
        $appointment = new Appointment();
        $appointment->patients_id = $request->patientId;
        $appointment->appointment_at = $appointment_at;
        $appointment->treatment_type = $request->inputTreatmentType;

        $p = Patient::findOrFail($appointment->patients_id);
        $p->last_appointment = $appointment_at;
        $p->treatment_type = $appointment->treatment_type;
        $p->save();

        $appointment->save();

        //send SMS
        $m_to = $p->mobile;
        $m_message = 
'Dear '.$p->name.', 
Your appointment with Dr. SM Bakhtiar Kamal on '.$app_date.' at '.$app_time.' has been created. 
- Kamal Hair & Skin Center';
        
        // dd($app_test, $app_test2);
        $m_for = 'Initial SMS';
        $this->send_sms($m_to, $m_message, $p->id, $m_for, $appointment->id);

        return redirect()->back();
    }
    public function multi(Request $request) {
        $a = date_create_from_format("m/d/Y H:i a",$request->mAppointmentTime);
        $appointment_at = $a->format('Y-m-d H:i:s');
        
        $app_date = $a->format('d-m-Y');
        $app_time = $a->format('h:i A');

        $patient = new Patient();
        $patient->name = $request->mName;
        $patient->age = $request->mAge;
        $patient->gender = $request->mGender;
        $patient->mobile = $request->mMobile;
        $patient->address = $request->mAddress;
        $patient->last_appointment = $appointment_at;
        $patient->treatment_type = $request->mTreatmentType;
        $patient->save();

        $appointment = new Appointment();
        $appointment->patients_id = $patient->id;
        $appointment->appointment_at = $appointment_at;
        $appointment->treatment_type = $request->mTreatmentType;

        $appointment->save();

        // dd($patient, $appointment);
        //send SMS
        $m_to = $patient->mobile;
        $m_message = 
'Dear '.$patient->name.', 
Your appointment with Dr. SM Bakhtiar Kamal on '.$app_date.' at '.$app_time.' has been created. 
- Kamal Hair & Skin Center';
        $m_for = 'Initial SMS';
        $this->send_sms($m_to, $m_message, $patient->id, $m_for, $appointment->id);

        return redirect()->back();
    }

    public function edit($id) {
        $patients = Patient::all();
        $appointment = Appointment::findorFail($id);
        return view('appointment.edit', ['patients' => $patients, 'appointment' => $appointment]);
    }
    public function update(Request $request) {
        $appointment = Appointment::find($request->id);
        $a = date_create_from_format("m/d/Y H:i a",$request->inputAppointmentTime); //new \DateTimeZone('Asia/Dhaka')
        $b = $a;
        $appointment_at = $a->format('Y-m-d H:i:s');
        // dd($b, $request->inputAppointmentTime, $appointment_at);
        $app_date = $a->format('d-m-Y');
        $app_time = $a->format('h:i A');
        
        $appointment->patients_id = $request->patientId;
        $appointment->appointment_at = $appointment_at;
        $appointment->treatment_type = $request->inputTreatmentType;

        $p = Patient::findOrFail($appointment->patients_id);
        $p->last_appointment = $appointment_at;
        $p->treatment_type = $appointment->treatment_type;
        $p->save();

        $appointment->save();

        //send SMS
        $m_to = $p->mobile;
        $m_message = 
'Dear '.$p->name.', 
Your appointment with Dr. SM Bakhtiar Kamal on '.$app_date.' at '.$app_time.' has been created. 
- Kamal Hair & Skin Center';
        $m_for = 'Initial SMS - Update';
        $this->send_sms($m_to, $m_message, $p->id, $m_for, $appointment->id);

        return redirect()->route('appointment.index');
    }

    public function send_sms($to, $message, $patients_id, $for, $app_id){
        $token = "cb3301ba6e2d64b4f215d168cf48a0eb";
        $url = "http://api.greenweb.com.bd/api.php?json";

        $sms = new Message();
        $sms->patients_id = $patients_id;
        $sms->for = $for;
        $sms->text = $message;

        $app = Appointment::find($app_id);

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
            $app->initial_sms_sent = 1;
            $app->save();
        } else {
            $sms->status = 'Failed';
        }
        $sms->save();
    }
}
