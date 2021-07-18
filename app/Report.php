<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequestQuotitation; 

class Report extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description','dateReport','administrative_username','request_quotitations_id'
    ];
    public function requestQuotitation(){
        return $this->belongsTo(RequestQuotitation::class);
    }
}
