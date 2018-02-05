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
}
