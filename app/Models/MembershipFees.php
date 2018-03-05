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
        return $this->hasOne('App\Models\User', 'id', 'given_to')->select('name');
    }
}
