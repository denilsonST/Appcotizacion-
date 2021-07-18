<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\AdministrativeUnit;
use App\SpendingUnit;
use App\Permission;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nameRol','description'
    ];

    public function users(){
        return $this->belongsToMany(User::class)
                ->withPivot('id','administrative_unit_id','spending_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                ->withTimestamps();
    }

    public function spendingUnits(){
        return $this->belongsToMany(SpendingUnit::class)
                    ->withPivot('id','user_id','administrative_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }
    
    public function administrativeUnits(){
        return $this->belongsToMany(AdministrativeUnit::class)
                    ->withPivot('id','user_id','spending_unit_id','role_status','administrative_unit_status','spending_unit_status','global_status')
                    ->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
}
