<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcsDetails extends Model
{
    protected $table = "ecs_details";
    public $timestamps = false;
    protected $fillables = [
        //"SNO", 
        //"UMRN",
        //"BankCode", 
        "Beneficiary_AccNo", 
        //"Beneficiary_Name", 
        //"Settlement_Date", 
        "Amount", 
        //"Start_Date", 
        //"End_Date", 
        //"Frequency", 
        "member_id", 
        "status", 
        "original_file_id", 
    ];
    public function member_detail() {
        return $this->hasOne('App\Models\User', 'id', 'member_id');
    }
    public function pdf() {
        return $this->hasOne('App\Models\EcsBankData', 'id', 'original_file_id');
    }
}