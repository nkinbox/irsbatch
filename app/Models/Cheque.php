<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "loan_id", "number", "amount", "used_for"
    ];
}
