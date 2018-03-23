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
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function loan_incharge() {
        return $this->hasOne('App\Models\User', 'id', 'loan_incharge_id');
    }
    public function cashier() {
        return $this->hasOne('App\Models\User', 'id', 'cashier_id');
    }
    public function corecommittee() {
        return $this->hasOne('App\Models\User', 'id', 'corecommittee_id');
    }
}
