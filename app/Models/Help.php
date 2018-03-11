<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    public function member_detail() {
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function corecommittee_detail() {
        return $this->hasOne('App\Models\User', 'id', 'corecommittee_id');
    }
}
