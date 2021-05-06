<?php

namespace App\Exports;

use App\Record;
use App\Teacher;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class RecordsExport implements ShouldAutoSize,FromView
{
    use Exportable;
     public function __construct(int $teacher_id)
    {
        $this->teacher_id = $teacher_id;
    }

    public function View(): View
    {
        $teacher = Teacher::find($this->teacher_id);
        $prints = Record::where('Teacher_id',$this->teacher_id)->get();
        return view('excel.index',compact('prints','teacher'));
    }
}
