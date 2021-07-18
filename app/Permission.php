<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Permission extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'namePermission','description','url'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
