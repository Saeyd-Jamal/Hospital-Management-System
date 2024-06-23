<?php

namespace App\Http\Controllers;

use App\Exports\DoctorsExport;
use App\Imports\DoctorsImport;
use App\Models\Doctor;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('section')->paginate(10);
        return view('dashboard.doctors.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctor = new Doctor();
        $sections = Section::get();
        return view('dashboard.doctors.create',compact('doctor','sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'string|required|min:9|max:9|unique:doctors,doctor_id',
            'username' => 'string|required|unique:doctors,username',
            'imageFile' => 'file|image',
            'section_id' => 'exists:sections,id',
            'password' => 'required'
        ],[
            'exists' => "هذه القيمة غير متوفرة",
            "unique" => 'هذا العنصر مكرر لشخص اخر',
            'required' => 'هذا الحقل مطلوب يرجى التحقق منه'
        ]);
        if($request->hasFile('imageFile')){
            $imageFile = $request->file('imageFile');
            $imageName =  "doctor_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('doctors',$imageName);
            $request->merge([
                'image' => $imagePath,
            ]);
        }
        Doctor::create($request->all());
        return redirect()->route('doctors.index')->with('success', 'تم إضافة طبيب جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return redirect()->route('doctors.edit',$doctor->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $btn_label = "تعديل القسم";
        $editItem = true;
        $sections = Section::get();
        return view('dashboard.doctors.edit',compact('doctor','sections','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'doctor_id' => "string|required|min:9|max:9|unique:doctors,doctor_id," . $doctor->id,
            'username' => "string|required|unique:doctors,username," . $doctor->id,
            'imageFile' => 'file|image',
            'section_id' => 'exists:sections,id'
        ],[
            'exists' => "هذه القيمة غير متوفرة",
            "unique" => 'هذا العنصر مكرر لشخص اخر'
        ]);
        $old_iamge = $doctor->image;
        if($request->hasFile('imageFile')){
            if($old_iamge){
                Storage::delete($old_iamge);
            }
            $imageFile = $request->file('imageFile');
            $imageName =  "doctor_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('doctors',$imageName);
            $request->merge([
                'image' => $imagePath,
            ]);
        }
        if($request->post('password') == null){
            $doctor->update($request->except('password'));
            return redirect()->route('doctors.index')->with('success', 'تم تحديث بيانات طبيب بنجاح');
        }
        $doctor->update($request->all());
        return redirect()->route('doctors.index')->with('success', 'تم تحديث بيانات طبيب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $old_iamge = $doctor->image;
        if($old_iamge){
            Storage::delete($old_iamge);
        }
        $doctor->delete();
        return redirect()->route('doctors.index')->with('danger', 'تم حذف الطبيب');
    }
}
