<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TeacherCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($teacher){
                return [
                    'id' => $teacher->id,
                    'fullname'=>$teacher->fullname,
                    'position'=>$teacher->position,
                    'dateEmployed'=>$teacher->dateEmployed,
                    'sex'=>$teacher->sex,
                    'dob'=>$teacher->dob,
                    'pob'=>$teacher->pob,
                    'employeeNumber'=>$teacher->employeeNumber,
                    'station'=>$teacher->station,
                    'civilStatus'=>$teacher->civilStatus
                ];
            })
        ];
    }
}
