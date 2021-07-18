<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Faculty;
use App\LimiteAmount;
use App\Quotitation;
use App\User;
use App\SpendingUnit;
use App\Role;

class AdministrativeUnit extends Model
{
    protected $fillable = [
        'name','faculties_id'
    ];
    public function quotitation(){
        return $this->hasMany(Quotitation::class);
    }

    public function faculty(){
        return $this->belongsTo(Faculty::class);
    }

    public function limiteAmount(){
        return $this->hasMany(LimiteAmount::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'role_user')
                    ->withPivot('id','role_id','spending_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function spendingUnits(){
        return $this->belongsToMany(SpendingUnit::class)
                    ->withPivot('id','user_id','role_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function roles(){
        return $this->belongsToMany(Role::class)
                    ->withPivot('id','user_id','spending_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

}
