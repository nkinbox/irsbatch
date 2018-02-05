<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    //protected $table = 'documents';
    public $timestamps = false;
    protected $fillable = [
        'member_id', 'document_name', 'file_name'
    ];
}
