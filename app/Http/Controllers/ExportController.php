<?php

namespace App\Http\Controllers;

use App\Exports\SelectionExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportLolos()
    {
        return Excel::download(new SelectionExport, 'hasil-seleksi-diterima.xlsx');
    }
}