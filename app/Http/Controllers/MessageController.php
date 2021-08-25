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

class MessageController extends Controller
{
    public function index() {
        $messages = DB::table('messages')
                        ->leftJoin('patients', 'messages.patients_id', '=', 'patients.id')
                        ->select('messages.*', 'patients.name as name', 'patients.age as age', 'patients.gender as gender', 'patients.mobile as mobile')
                        ->latest()
                        ->get();
        return view('message.index', ['messages' => $messages]);
    }
    public function store($id) {
        $messages = DB::table('messages')
                        ->leftJoin('patients', 'messages.patients_id', '=', 'patients.id')
                        ->select('messages.*', 'patients.name as name', 'patients.age as age', 'patients.gender as gender', 'patients.mobile as mobile')
                        ->latest()
                        ->get();

        // resend sms
        $message = Message::find($id);
        $p = Patient::find($message->patients_id);
        $m_to = $p->mobile;
        $m_message = $message->text;
        $m_for = $message->for;
        $this->send_sms($m_to, $m_message, $p->id, $m_for);

        return redirect()->route('message.index', ['messages' => $messages]);
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
