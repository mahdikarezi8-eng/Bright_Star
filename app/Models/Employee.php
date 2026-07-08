<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

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
        'province',
        'position',
        'gross_salary',
        'reg_date'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function employee_salary(){
        return $this->hasMany(EmployeeSalary::class);
    }

    public function employee_document(){
        return $this->hasMany(EmployeeDocument::class);
    }

    public function employee_attendances(){
        return $this->hasMany(EmployeeAttendance::class);
    }

    
}
