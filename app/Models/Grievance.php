<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    public function member_detail() {
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function lobbyhead_detail() {
        return $this->hasOne('App\Models\User', 'id', 'lobbyhead_id');
    }
    public function corecommittee_detail() {
        return $this->hasOne('App\Models\User', 'id', 'corecommittee_id');
    }
    public function president_detail() {
        return $this->hasOne('App\Models\User', 'id', 'president_id');
    }
}
