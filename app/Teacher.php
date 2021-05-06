<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded=[];

    public function records(){
        return $this->hasMany(Record::class);
    }
}
