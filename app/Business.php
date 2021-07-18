<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameEmpresa','nit','email','phone','direction','rubro'
    ];

    public function quotations(){
        return $this->hasMany(Quotation::class);
    }
}
