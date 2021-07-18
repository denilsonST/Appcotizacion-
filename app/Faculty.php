<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AdministrativeUnit;
use App\SpendingUnit;

class Faculty extends Model
{
    protected $fillable = [
        'nameFacultad','inUse'
    ];

    public function administrativeUnit(){
        return $this->hasOne(AdministrativeUnit::class);
    }

    public function spendingUnit(){
        return $this->hasMany(SpendingUnit::class);
    }
}
