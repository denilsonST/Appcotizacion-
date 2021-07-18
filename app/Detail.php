<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Quotation;
use App\RequestDetail;
class Detail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = [
        'unitPrice','totalPrice','request_details_id','quotations_id','brand','industry','model','warrantyTime'
    ];
    public function quotitation(){
        return $this->belongsTo(Quotation::class);
    }
    public function requestDetail(){
        return $this->belongsTo(RequestDetail::class);
    }
}
