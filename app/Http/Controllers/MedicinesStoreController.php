<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Exports\MedicinesStoreExport;
use App\Imports\MedicinesStoreImport;
use App\Models\MedicinesStore;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class MedicinesStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = MedicinesStore::paginate(10)->withQueryString();
        $model = json_encode(MedicinesStore::class);
        $modelName = "medicines";
        $colmesNames = json_encode(['name','description','producing_company','end_date','quantity','price_sale','basic_price','profit']);
        $colmesNamesHeading = json_encode(['اسم الدواء','وصف للدواء','الشركة المنتجة','تاريخ الانتهاء','الكمية','سعر البيع','السعر الاساسي','الربح']);
        return view('dashboard.medicines.index',compact('medicines','model','colmesNames','colmesNamesHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicine = new MedicinesStore();
        return view('dashboard.medicines.create',compact('medicine'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('imageFile')){
            $imageFile = $request->file('imageFile');
            $imageName =  "medicines_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('medicines',$imageName);
            $request->merge([
                'medicine_image' => $imagePath,
            ]);
        }
        MedicinesStore::create($request->all());
        return redirect()->route('medicines.index')->with('success', 'تم إضافة دواء جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicinesStore $MedicinesStore)
    {
        return redirect()->route('medicines.edit',$MedicinesStore->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicinesStore $medicine)
    {
        $btn_label = "تعديل بيانات الدواء";
        $editItem = true;
        return view('dashboard.medicines.edit',compact('medicine','btn_label','editItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicinesStore $Medicine)
    {
        $old_iamge = $Medicine->medicine_image;
        if($request->hasFile('imageFile')){
            if($old_iamge){
                Storage::delete($old_iamge);
            }
            $imageFile = $request->file('imageFile');
            $imageName =  "medicine_" . Str::slug($request->post('name')) . "_" . Carbon::now()->format('Y-m-d') . "." . $imageFile->extension();
            $imagePath = $imageFile->storeAs('medicines',$imageName);
            $request->merge([
                'medicine_image' => $imagePath,
            ]);
        }
        $Medicine->update($request->all());
        return redirect()->route('medicines.index')->with('success', 'تم تحديث بيانات الدواء بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicinesStore $Medicine)
    {
        $old_iamge = $Medicine->medicine_image;
        if($old_iamge){
            Storage::delete($old_iamge);
        }
        $Medicine->delete();
        return redirect()->route('medicines.index')->with('danger', 'تم حذف الدواء المحدد');
    }


    // Excel
    public function importExcel(Request $request)
    {
        $file = $request->file('fileExcel');
        if($file == null){
            return redirect()->back()->with('error', 'لم يتم رفع الملف');
        }
        Excel::import(new MedicinesStoreImport, $file);

        return redirect()->route('medicines.index')->with('success', 'تم رفع البيانات');
    }
    // public function exportExcel()
    // {
    //     $times = Carbon::now();
    //     $nameFile = "medicines_" . $times . ".xlsx";
    //     $colmesNames = ['name','description','producing_company','end_date','quantity','price_sale','basic_price','profit'];
    //     $colmesNamesHeading = ['اسم الدواء','وصف للدواء','الشركة المنتجة','تاريخ الانتهاء','الكمية','سعر البيع','السعر الاساسي','الربح',];
    //     return Excel::download(new ExcelExport(new MedicinesStore,$colmesNames,$colmesNamesHeading), $nameFile);
    //     // return Excel::download(new MedicinesStoreExport, $nameFile);
    // }
}
