<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];
    public function documents() {
        return $this->hasMany('App\Models\Documents', 'member_id');
    }
    public function introduced_by() {
        return $this->hasOne('App\Models\User', 'id', 'introduce_no');
    }
    public function position() {
        return $this->hasOne('App\Models\OfficeBearer', 'id', 'position_id');
    }
    public function membership_fees() {
        return $this->hasMany('App\Models\MembershipFees', 'member_id', 'id');
    }
}
