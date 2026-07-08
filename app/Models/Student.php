<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'gender',
        'birth_year',
        'image',
        'nic',
        'phone',
        'email',
        'curent_address',
        'class_id',
    ];

    public function student_attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function student_document()
    {
        return $this->hasMany(StudentDocument::class);
    }

    public function student_fees()
    {
        return $this->hasMany(StudentFees::class);
    }

    public function class()
    {
        return $this->belongsTo(Classe::class);
    }


    public function Scores()
    {
        return $this->hasMany(score::class, 'student_id');
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
