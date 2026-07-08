<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    protected $primaryKey = 'staff_id , attendance_date';
    public $timestamps = false;

    protected $table = 'employee_attendance';
      protected $fillable = [
        'employee_id',
        'attendance_date',
        'remark',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

   

    
}
