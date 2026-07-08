<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    protected $table = 'employee_salary';
    protected $fillable = [
        'employee_id',
        'salary_year',
        'salary_month',
        'pay_date',
        'absent_amount',
        'net_salary',
    ];

    // protected $incrementing = false;

    protected $primaryKey = 'staff_id , salary_year , salary_month';
    public $timestamps = false;



    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    
}
