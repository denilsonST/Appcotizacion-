<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LimiteAmount extends Model
{
    protected $fillable = [
        'monto','starDate','endDate','steps','administrative_units_id'
    ];
    public function AdministrativeUnit(){
        return $this->belongsTo(AdministrativeUnit::class);
    }
}
