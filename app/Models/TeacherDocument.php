<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherDocument extends Model
{
   protected $table = 'teacher_document';
   protected $fillable =['teacher_id','document_name','upload_date'];



   public function teacher(){
    return $this->belongsTo(Teacher::class,'teacher_id');
   }
}
