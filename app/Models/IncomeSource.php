<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $table = 'income_sources';

    protected $fillable = ['source_name'];
    public function incomes(){
        return $this->hasMany(Income::class);
    }


}
