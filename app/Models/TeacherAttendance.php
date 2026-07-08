<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $table = "teacher_attendance";
    public $timestamps = false;
    protected $fillable = [
        'teacher_id',
        'absent_date',
        'remark'
    ];

    public function teacher()
    {
        return $this->belongsTo(TeacherAttendance::class, 'teacher_id');
    }
}
