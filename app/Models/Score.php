<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    public $timestamps = false;
    protected $fillable = ['student_id','subject_id','exam_year','class_id','first_chance','second_chance'];

    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class,'subject_id');
    }

}
