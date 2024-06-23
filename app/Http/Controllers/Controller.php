<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use App\Models\MedicinesStore;
use App\Models\PatientReservation;
use App\Models\PharmacyBill;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Maatwebsite\Excel\Facades\Excel;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function exportExcelA(Request $request)
    {
        $colmesNamesC = json_decode($request->colmesNames);
        $colmesNamesHeadingC = json_decode($request->colmesNamesHeading);
        $model = json_decode($request->model);
        $modelName = $request->modelName;
        $model_c = new $model;
        $times = Carbon::now();
        $nameFile = $modelName . "_" . $times . ".xlsx";
        return Excel::download(new ExcelExport($model_c,$colmesNamesC,$colmesNamesHeadingC), $nameFile);
    }
}
