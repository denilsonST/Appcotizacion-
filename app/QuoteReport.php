<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RequestQuotitation; 

class QuoteReport extends Model
{
    protected $fillable = [
        'description','dateReport','aplicantName','request_quotitations_id'
    ];

    public function requestQuotitation1(){
        return $this->belongsTo(RequestQuotitation::class);
    }
}
