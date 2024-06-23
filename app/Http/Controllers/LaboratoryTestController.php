<?php

namespace App\Http\Controllers;

use App\Exports\LaboratoryTestExport;
use App\Imports\LaboratoryTestImport;
use App\Models\LaboratoryTest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class LaboratoryTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratoryTests = LaboratoryTest::paginate(10)->withQueryString();
        return view('dashboard.laboratory_tests.index',compact('laboratoryTests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $laboratoryTest = new LaboratoryTest();
        return view('dashboard.laboratory_tests.create',compact('laboratoryTest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('file_test_u')){
            $testFile = $request->file('file_test_u');
            $testName =  "laboratory_tests_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $testFile->extension();
            $testPath = $testFile->storeAs('laboratory_tests',$testName);
            $request->merge([
                'file_test' => $testPath,
            ]);
        }
        LaboratoryTest::create($request->all());
        return redirect()->route('laboratory_tests.index')->with('success', 'تم إضافة فحص جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(LaboratoryTest $laboratoryTest)
    {
        return redirect()->route('laboratory_tests.edit',$laboratoryTest->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaboratoryTest $laboratoryTest)
    {
        $btn_label = "تعديل بيانات الفحص";
        $editItem = true;
        return view('dashboard.laboratory_tests.edit',compact('laboratoryTest','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaboratoryTest $laboratoryTest)
    {
        $old_test_file = $laboratoryTest->file_test;
        if($request->hasFile('file_test_u')){
            if($old_test_file){
                Storage::delete($old_test_file);
            }
            $testFile = $request->file('file_test_u');
            $testName =  "laboratory_tests_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $testFile->extension();
            $testPath = $testFile->storeAs('laboratory_tests',$testName);
            $request->merge([
                'file_test' => $testPath,
            ]);
        }
        $laboratoryTest->update($request->all());
        return redirect()->route('laboratory_tests.index')->with('success', 'تم تحديث بيانات الفحص بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratoryTest $laboratoryTest)
    {
        $old_test_file = $laboratoryTest->file_test;
        if($old_test_file){
            Storage::delete($old_test_file);
        }
        $laboratoryTest->delete();
        return redirect()->route('laboratory_tests.index')->with('danger', 'تم حذف الفحص المحدد');
    }


    // Excel
    public function importExcel(Request $request)
    {
        $file = $request->file('fileExcel');
        if($file == null){
            return redirect()->back()->with('error', 'لم يتم رفع الملف');
        }
        Excel::import(new LaboratoryTestImport, $file);

        return redirect()->route('laboratory_tests.index')->with('success', 'تم رفع البيانات');
    }
    public function exportExcel()
    {
        $times = Carbon::now();
        $nameFile = "laboratory_tests_" . $times . ".xlsx";
        return Excel::download(new LaboratoryTestExport, $nameFile);
    }
}
