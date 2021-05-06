<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RecordsExport;
use Maatwebsite\Excel\facades\Excel;
use App\Teacher;

class DownloadController extends Controller
{
    public function xslx_export(Teacher $teacher)
    {
        return Excel::download(new RecordsExport($teacher['id']),strtr(ucwords($teacher['fullname']), ' ','_').'_'.date("F_d_Y").'.xlsx');
    }
}
