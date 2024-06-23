<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\MedicinesStore;
use App\Models\Patient;
use App\Models\PatientReservation;
use App\Models\PharmacyBill;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = PatientReservation::paginate();
        $model = json_encode(PatientReservation::class);
        $modelName = "reservations";
        $colmesNames = json_encode(['id','buy_date', 'payment_method','total_price','final_profit']);
        $colmesNamesHeading = json_encode(['رقم الفاتورة','تاريخ الشراء','طريقة الشراء','السعر الإجمالي','المربح الإجمالي']);
        return view('dashboard.reservations.index',compact('reservations','model','modelName','colmesNames','colmesNamesHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservation = new PatientReservation();
        $reservation->date = Carbon::now()->format('Y-m-d');
        $reservation->price = 20;
        $doctors = Doctor::get();
        $sections = Section::get();
        $medicines = MedicinesStore::get();
        return view('dashboard.reservations.create',compact('reservation','medicines','doctors','sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PatientReservation::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'section_id' => $request->section_id,
            'date' => $request->date,
            'price' => $request->price,
            'status' => $request->status,
        ]);
        return redirect()->route('reservations.index')->with('success', 'تم إضافة حجز جديدة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = PatientReservation::findOrFail($id);
        $doctors = Doctor::get();
        $sections = Section::get();
        $bill = PharmacyBill::findOrFail($reservation->bill->id);
        $medicines = $bill->medicines()->get();
        return view('dashboard.reservations.show',compact('reservation','medicines','doctors','sections'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = PatientReservation::findOrFail($id);
        $doctors = Doctor::get();
        $sections = Section::get();
        $medicines = MedicinesStore::get();
        $editItem = true;
        $btn_label = "ارسل";
        return view('dashboard.reservations.edit',compact('reservation','medicines','doctors','sections','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try{
            $bill = PharmacyBill::create([
                'buy_date' => $request->date,
                'total_price' => $request->total_price,
                'final_profit' => $request->final_profit,
                'reservation_id' => $id
            ]);
            $bill->medicines()->syncWithoutDetaching($request->checkedRows);
            foreach($bill->medicines()->get() as $medicine){
                $medicine->update([
                    'quantity' => $medicine->quantity - $medicine->pivot->quantity
                ]);
            }
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = PatientReservation::findOrFail($id);
        $reservation->delete();
        $reservation->bill()->delete();
    }
    public function getDoctors(Request $request){
        $section_id = $request->post('section_id');
        $doctors = Doctor::where('section_id','=',$section_id)->get();
        return $doctors;
    }

    public function getPatient(Request $request){
        $patient_search_type = $request->post('type');
        $patient_search = $request->post('patient');
        $patient_search_id = session()->get('patient_id');
        $patient_search_name = session()->get('patient_name');

        if($patient_search_type == 'patient_id'){
            session()->put('patient_id' , $patient_search);
            $patient_search_id = session()->get('patient_id');
        }

        if($patient_search_type == 'patient_name'){
            session()->put('patient_name' , $patient_search);
            $patient_search_name = session()->get('patient_name');
        }

        if(($patient_search_id == false && $patient_search_name == false)
            Or (($patient_search_id != false && $patient_search_name == false)
            Or ($patient_search_id == false && $patient_search_name != false))
        )
        {
            if($patient_search_type == 'patient_id'){
                $patients = Patient::where('patient_id','LIKE',"{$patient_search_id}%")->get();
            }
            if($patient_search_type == 'patient_name'){
                $patients = Patient::where('name','LIKE',"%{$patient_search_name}%")->get();
            }
        }else{
            $patients = Patient::where('patient_id','LIKE',"%{$patient_search_id}%")->where('name','LIKE',"%{$patient_search_name}%")->get();
        }

        return $patients;
    }

    public function getReservations(Request $request){
        $reservations = PatientReservation::where('doctor_id',$request->user()->id)->get();
        // $reservations->name = $reservations->patient->name;
        foreach($reservations as $reservation){
            $reservation->name = $reservation->patient->name;
        }
        return $reservations;
    }
}
