<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $guarded=[];

//    public function grade(){
//        return $this->belongsTo(Grade::class,'grade_id');
//    }
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }

}
