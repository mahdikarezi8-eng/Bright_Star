<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $table='outcomes';
    protected $fillable = ['source_id','outcome_amount','outcome_date'];

    public function outcome_source(){
        return $this->belongsTo(OutcomeSource::class,'source_id');
    }
     

}
