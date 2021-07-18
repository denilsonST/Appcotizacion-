<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyCode;
use App\Detail;
class Quotation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offerValidity','deliveryTime','paymentMethod','answerDate','observation','company_codes_id','business_id'
    ];
    public function companyCode(){
        return $this->belongsTo(CompanyCode::class);
    }
    public function details(){
        return $this->hasMany(Detail::class);
    }
    public function business(){
        return $this->belongsTo(Business::class);
    }
}
