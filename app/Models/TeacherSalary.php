<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSalary extends Model
{
   protected $table = 'teacher_salary';
   public $timestamps = false;
   protected $fillable = ['teacher_id','salary_year','salary_month','absent_amount','bonus','net_salary','pay_date'];


   public function teacer(){
      return $this->belongsTo(Teacher::class,'teacher_id');
   }
}
