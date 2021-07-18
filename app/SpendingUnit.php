<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\AdministrativeUnit;
use App\Role;
use App\RequestQuotitation;
use App\Faculty;

class SpendingUnit extends Model
{
    //
    protected $fillable = [
        'nameUnidadGasto','faculties_id'
    ];

    public function faculties(){
        return $this->belongsTo(Faculty::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'role_user')
                    ->withPivot('id','role_id','administrative_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'role_user')
                    ->withPivot('id','user_id','administrative_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function administrativeUnits(){
        return $this->belongsToMany(AdministrativeUnit::class,'role_user')
                    ->withPivot('id','user_id','role_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function requestQuotitations(){
        return $this->hasMany(RequestQuotitation::class);
    }
}
