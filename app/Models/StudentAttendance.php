<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendance';
    public $timestamps = false;

    protected $primaryKey = 'student_id , attendance_date';

    protected $fillable = [
        'student_id',
        'absent_date',
        'absent_type',
    ];
    
    public function student(){
        return $this->belongsTo(Student::class);
    }
}