<?php

namespace App\Http\Controllers;

use App\Exports\PatientsExport;
use App\Imports\PatientsImport;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(10)->withQueryString();
        return view('dashboard.patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patient = new Patient();
        return view('dashboard.patients.create',compact('patient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'string|required|min:9|max:9|unique:patients,patient_id',
            'imageFile' => 'file|image',
        ],[
            "unique" => 'هذا العنصر مكرر لشخص اخر',
            'required' => 'هذا الحقل مطلوب يرجى التحقق منه'
        ]);
        if($request->hasFile('imageFile')){
            $imageFile = $request->file('imageFile');
            $imageName =  "patient_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('patients',$imageName);
            $request->merge([
                'image' => $imagePath,
            ]);
        }
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'تم إضافة مريض جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        return redirect()->route('patients.edit',$patient->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $btn_label = "تعديل بيانات المريض";
        $editItem = true;
        return view('dashboard.patients.edit',compact('patient','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'patient_id' => "string|required|min:9|max:9|unique:patients,patient_id," . $patient->id,
            'imageFile' => 'file|image',
        ],[
            'exists' => "هذه القيمة غير متوفرة",
            "unique" => 'هذا العنصر مكرر لشخص اخر'
        ]);
        $old_iamge = $patient->image;
        if($request->hasFile('imageFile')){
            if($old_iamge){
                Storage::delete($old_iamge);
            }
            $imageFile = $request->file('imageFile');
            $imageName =  "patient_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('patients',$imageName);
            $request->merge([
                'image' => $imagePath,
            ]);
        }
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $Patient)
    {
        $old_iamge = $Patient->image;
        if($old_iamge){
            Storage::delete($old_iamge);
        }
        $Patient->delete();
        return redirect()->route('patients.index')->with('danger', 'تم حذف المريض المحدد');
    }


    // Excel
    public function importExcel(Request $request)
    {
        $file = $request->file('fileExcel');
        if($file == null){
            return redirect()->back()->with('error', 'لم يتم رفع الملف');
        }
        Excel::import(new PatientsImport, $file );

        return redirect()->route('patients.index')->with('success', 'تم رفع البيانات');
    }
    public function exportExcel()
    {
        $times = Carbon::now();
        $nameFile = "patients_" . $times . ".xlsx";
        return Excel::download(new PatientsExport, $nameFile);
    }
}
