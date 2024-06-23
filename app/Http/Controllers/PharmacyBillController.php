<?php

namespace App\Http\Controllers;

use App\Models\MedicinesStore;
use App\Models\PharmacyBill;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

use function Laravel\Prompts\error;

class PharmacyBillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = PharmacyBill::paginate();
        $model = json_encode(PharmacyBill::class);
        $modelName = "pharmacy";
        $colmesNames = json_encode(['id','buy_date', 'payment_method','total_price','final_profit']);
        $colmesNamesHeading = json_encode(['رقم الفاتورة','تاريخ الشراء','طريقة الشراء','السعر الإجمالي','المربح الإجمالي']);
        return view('dashboard.pharmacy.bills',compact('bills','model','modelName','colmesNames','colmesNamesHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bill = new PharmacyBill();
        $bill->buy_date = Carbon::now()->format('Y-m-d');
        $medicines = MedicinesStore::get();
        return view('dashboard.pharmacy.create',compact('bill','medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->total_price == null || $request->total_price == 0){
            return redirect()->route('pharmacy.index')->with('success', 'تم إضافة فاتورة جديدة بنجاح');
        }
        DB::beginTransaction();
        try{
            $bill = PharmacyBill::create($request->all());
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
     * Display the specified resource.
     */
    public function show(PharmacyBill $pharmacy)
    {
        $btn_label = "تم";
        $editItem = true;
        $bill = $pharmacy;
        $medicines = $pharmacy->medicines()->get();
        return view('dashboard.pharmacy.bill',compact('bill','btn_label','editItem','medicines'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PharmacyBill $pharmacy)
    {
        $btn_label = "تعديل الفاتورة";
        $editItem = true;
        $bill = $pharmacy;
        $medicines = $pharmacy->medicines()->get();
        return view('dashboard.pharmacy.edit',compact('bill','btn_label','editItem','medicines'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PharmacyBill $pharmacyBill)
    {
        if($request->total_price == null || $request->total_price == 0){
            return redirect()->route('pharmacy.index')->with('success', 'تم صرف الحجز');
        }
        DB::beginTransaction();
        try{
            $pharmacyBill->update($request->all());
            $pharmacyBill->medicines()->sync($request->checkedRows);
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('pharmacy.index',$pharmacyBill->id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PharmacyBill $pharmacyBill)
    {
        $pharmacyBill->delete();
        return redirect()->route('pharmacy.index')->with('danger', 'تم حذف الفاتورة المحددة');
    }



    public function reservations(){
        $bills = PharmacyBill::today()->reservations()->paginate();
        return view('dashboard.pharmacy.reservations',compact('bills'));
    }
    public function reservationsAjaxData(){
        $bills = PharmacyBill::today()->reservations()
                                ->get();
        return $bills;
    }

}
