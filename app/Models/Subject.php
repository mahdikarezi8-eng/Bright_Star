<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $table = 'subjects';
    protected $fillable = [
        'subject_name',
        'authore',
    ];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'class_subject', 'subject_id', 'class_id');
    }

    public function Scores()
    {
        return $this->hasMany(Score::class, 'subject_id');
    }

    public function Timetable()
    {
        return $this->hasMany(Timetable::class, 'subject_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class ,'teacher_subject','subject_id','teacher_id');
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    
}
