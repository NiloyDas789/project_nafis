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

class PatientController extends Controller
{
    public function store(Request $request) {
        $patient = new Patient();
        $patient->name = $request->inputName;
        $patient->age = $request->inputAge;
        $patient->gender = $request->inputGender;
        $patient->mobile = $request->inputMobile;
        $patient->address = $request->inputAddress;
        $patient->save();
        return redirect()->back();
    }

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
        $patients = $patients->where('is_deleted', 0)->latest()->get();
        // dd($patients);
        return view('patient.index', ['patients' => $patients]);
    }

    public function edit($id) {
        $patient = Patient::findorFail($id);
        return view('patient.edit', ['patient' => $patient]);
    }
    public function update(Request $request) {
        $patient = Patient::findOrFail($request->id);
        $patient->name = $request->inputName;
        $patient->age = $request->inputAge;
        $patient->gender = $request->inputGender;
        $patient->mobile = $request->inputMobile;
        $patient->address = $request->inputAddress;
        $patient->save();
        return redirect()->route('patient.index');
    }
    public function delete($id) {
        $patient = Patient::findorFail($id);
        $patient->is_deleted = 1;
        $patient->save();
        $patients = Patient::where('is_deleted', 0)->latest()->get();
        return view('patient.index', ['patients' => $patients]);
    }
}
