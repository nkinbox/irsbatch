<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipCancellation extends Model
{
    public function member_detail() {
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function lobbyhead_detail() {
        return $this->hasOne('App\Models\User', 'id', 'lobbyhead');
    }
    public function corecommittee_detail() {
        return $this->hasOne('App\Models\User', 'id', 'corecommittee');
    }
}
