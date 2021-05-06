<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;
use App\Teacher;

class RecordController extends Controller
{
    public function show($id){
        return response()->json(Teacher::find($id)->records);
    }

    public function store(Request $request){
        return Record::create($request->all());
    }
    
    public function edit(Record $record){
        return response()->json($record);
    }

    public function update(Request $request){
        return response()->json(Record::find($request->id)->update($request->all()));
    }

    public function destroy($id){
        return Record::destroy($id);
    }

    public function print($id){
        return view('print.print',['prints'=>Teacher::select('teachers.*','records.*')->join('records','teachers.id','=','records.teacher_id')->where('teachers.id',$id)->get()]);
    }

    public function lawop($id){
        return response()->json(Record::where(['teacher_id'=>$id,'remarks'=>'W/OUT PAY'])->get());
    }

}
