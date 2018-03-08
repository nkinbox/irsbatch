<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipFees extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "member_id",
        "status",
        "fees_amount",
        "paid_amount",
        "fees_month",
        "fees_year",
        "pay_date",
        "pay_method",
        "ecs_id",
    ];
    public function paid_to() {
        return $this->hasOne('App\Models\User', 'id', 'given_to')->select('id', 'name');
    }
    public function verifier() {
        return $this->hasOne('App\Models\User', 'id', 'verified_by')->select('id', 'name');
    }
    public function member_detail() {
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function cheque_detail() {
        return $this->hasOne('App\Models\Cheque', 'id', 'cheque_id');
    }
}
