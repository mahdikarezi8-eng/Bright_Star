<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';
    protected $fillable = ['source_id','income_amount','income_date'];

    public function income_source(){
        return $this->belongsTo(IncomeSource::class,'source_id');
    }    



}
