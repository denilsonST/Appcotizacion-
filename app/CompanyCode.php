<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequestQuotitation;
use App\Quotation;

class CompanyCode extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code','email','request_quotitations_id'
    ];
    public function requestQuotitation(){
        return $this->belongsTo(RequestQuotitation::class);
    }
    public function quotitation(){
        return $this->belongsTo(Quotation::class);
    }
}
