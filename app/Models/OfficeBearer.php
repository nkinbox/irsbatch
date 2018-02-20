<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeBearer extends Model
{
    protected $table = "office_bearer";
    public $timestamps = false;
    public function position_holder() {
        return $this->hasMany('App\Models\User', 'position_id', 'id');
    }
}
