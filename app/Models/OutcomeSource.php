<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutcomeSource extends Model
{
    protected $table = 'outcome_sources';
    protected $fillable = ['outcome_name'];

    public function outcomes(){
        return $this->hasMany(Outcome::class);
    }
}
