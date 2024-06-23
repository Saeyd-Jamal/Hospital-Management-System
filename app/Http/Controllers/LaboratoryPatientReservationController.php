<?php

namespace App\Http\Controllers;

use App\Models\LaboratoryPatientReservation;
use App\Models\LaboratoryTest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class LaboratoryPatientReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = LaboratoryPatientReservation::paginate();
        $model = json_encode(LaboratoryPatientReservation::class);
        $modelName = "laboratory";
        $colmesNames = json_encode(['id', 'test_date','total_price']);
        $colmesNamesHeading = json_encode(['رقم الحجز','تاريخ الحجز','السعر الإجمالي']);
        return view('dashboard.laboratory.index',compact('reservations','model','modelName','colmesNames','colmesNamesHeading'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservation = new LaboratoryPatientReservation();
        $reservation->test_date = Carbon::now()->format('Y-m-d');
        $tests = LaboratoryTest::get();
        return view('dashboard.laboratory.create',compact('reservation','tests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->total_price == null || $request->total_price == 0){
            return redirect()->route('laboratory.index')->with('success', 'تم إضافة فاتورة جديدة بنجاح');
        }
        DB::beginTransaction();
        try{
            $reservation = LaboratoryPatientReservation::create($request->all());
            $reservation->LaboratoryTests()->syncWithoutDetaching($request->checkedRows);
            DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(LaboratoryPatientReservation $laboratoryPatientReservation)
    {
        $btn_label = "تم";
        $editItem = true;
        $reservation = $laboratoryPatientReservation;
        $tests = $reservation->LaboratoryTests()->get();
        return view('dashboard.laboratory.show',compact('reservation','btn_label','editItem','tests'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LaboratoryPatientReservation $laboratoryPatientReservation)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LaboratoryPatientReservation $laboratoryPatientReservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LaboratoryPatientReservation $laboratoryPatientReservation)
    {
        $laboratoryPatientReservation->delete();
        return redirect()->route('laboratory.index')->with('danger', 'تم حذف الفاتورة المحددة');
    }
}
