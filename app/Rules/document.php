<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Validator;

class document implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {   
        $rule = array();
        for($i = 0; $i < count($value); $i++) {
            for($j = 0; $j < count($value[$i]); $j++) {
                $rule[$attribute.'.'.$i.'.'.$j] = "required|image|max:20000";
            }
        }
        $validator = Validator::make([$attribute => $value], $rule);
        if ($validator->fails()) {
            return false;
        }
        return true;
    }

    public function message()
    {
        return 'Uploaded Files must be Valid Images and Under 20MB';
    }
}
