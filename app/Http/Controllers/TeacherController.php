<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherCollection;
use Illuminate\Http\Request;
use App\Teacher;
class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        return new TeacherCollection(Teacher::orderBy('fullname','ASC')->paginate(10));
    }

    public function search($field,$query)
    {
        return new TeacherCollection(Teacher::where($field,'LIKE',"%$query%")->latest()->paginate(10));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       //
    }

    public function liveSearch(){
        return response()->json(Teacher::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validated= $request->validate([
            'fullname'=>'required',
            'position'=>'required',
            'dateEmployed'=>'required',
            'sex'=>'required',
            'dob'=>'required',
            'pob'=>'required',
            'employeeNumber'=>'required|integer',
            'station'=>'required',
            'civilStatus'=>'required'
        ]);
        Teacher::create($validated);
        return response()->json(['msg'=>'SuccessFully added!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $teacher= Teacher::where('id',$request->id)->update($request->all());
        return response()->json(['data'=>$teacher]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        // return new TeacherResource($teacher);
        return response()->json(['data'=>$teacher]);
    }

    public function total(){
        return response()->json(Teacher::all());
    }
}
