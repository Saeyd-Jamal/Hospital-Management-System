<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LaboratoryPatientReservationController;
use App\Http\Controllers\LaboratoryTestController;
use App\Http\Controllers\MedicinesStoreController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PharmacyBillController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SectionController;
use App\Models\PharmacyBill;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group([
    'middleware' => ['auth:web'],
],function(){
    Route::get('/', function () {return view('dashboard.index');})->name('home');

    // Excel
    Route::post('patients/importExcel/', [PatientController::class, 'importExcel'])->name('patients.importExcel');
    Route::get('patients/exportExcel/', [PatientController::class, 'exportExcel'])->name('patients.exportExcel');
    Route::post('medicines/importExcel/', [MedicinesStoreController::class, 'importExcel'])->name('medicines.importExcel');
    Route::post('laboratory_tests/importExcel/', [LaboratoryTestController::class, 'importExcel'])->name('laboratory_tests.importExcel');
    Route::get('laboratory_tests/exportExcel/', [LaboratoryTestController::class, 'exportExcel'])->name('laboratory_tests.exportExcel');
    Route::get('exportExcel/',[Controller::class, 'exportExcelA'])->name('exportExcel');
    //Add route Functions
    Route::get('pharmacy/reservations', [PharmacyBillController::class, 'reservations'])->name('pharmacy.reservation');
    Route::get('pharmacy/reservations/DataAjax', [PharmacyBillController::class, 'reservationsAjaxData'])->name('pharmacy.reservationsAjaxData');

    Route::post('reservations/getDoctors',[ReservationController::class, 'getDoctors'])->name('getDoctors');
    Route::post('reservations/getPatient',[ReservationController::class, 'getPatient'])->name('getPatient');

    Route::resources([
        'sections' => SectionController::class,
        'doctors' => DoctorController::class,
        'patients' => PatientController::class,
        'medicines' => MedicinesStoreController::class,
        'laboratory_tests' => LaboratoryTestController::class,
        'laboratory' => LaboratoryPatientReservationController::class,
        'pharmacy' => PharmacyBillController::class,
        'reservations' => ReservationController::class,
    ]);
});


Route::group([
    'middleware' => ['auth:doctor'],
    'prefix' => 'doctor',
],function(){
    Route::get('view', function () {return view('dashboard.index');});
});
