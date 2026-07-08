<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = [
        'user_id',
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
        'education_degree',
        'education_university',
        'education_year',
        'talent_score',
        'talnet_score',
        'gross_salary',
        'food',
        'reg_date',
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher_salaries()
    {
        return $this->hasMany(TeacherSalary::class);
    }

    public function teacher_document()
    {
        return $this->hasMany(TeacherDocument::class);
    }


    public function teacher_attendances()
    {
        return $this->hasMany(TeacherAttendance::class, 'teacher_id');
    }


    public function Timetable()
    {
        return $this->hasMany(Timetable::class, 'teacher_id');
    }

    public function subjects()
{
    return $this->belongsToMany(Subject::class,'teacher_subject','teacher_id','subject_id');
}
}
