<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public $timestamps = false;
    public function repayment_cheques() {
        return $this->hasMany('App\Models\Cheque', 'loan_id', 'id')->where('used_for', 'repayment');
    }
    public function loan_cheques() {
        return $this->hasMany('App\Models\Cheque', 'loan_id', 'id')->where('used_for', 'loan');
    }
    public function member_detail() {
        return $this->hasMany('App\Models\User', 'id', 'member_id');
    }
}
