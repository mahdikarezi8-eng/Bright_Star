<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $table = 'classes';
    protected $fillable = ['class_name', 'fees', 'capacity', 'image', 'description'];
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'class_subject', 'class_id', 'subject_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function time_table()
    {
        return $this->HasMany(Timetable::class);
    }
}


