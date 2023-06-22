<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function questions(){
        return $this->hasMany(Question::class,'survey_id');
    }

    public function Teacher_answers(){
        return $this->hasMany(TeacherSurvey::class,'survey_id');
    }
}
