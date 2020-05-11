<?php

namespace App\Rules;

use App\Addresslog;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ConsigneeAliasRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $data;
    public function __construct()
    {
       // $this->data = $data;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $addresslogs = Addresslog::where('user_id', Auth::user()->id)->get();
        $addresslog_where = Addresslog::where('user_id', Auth::user()->id)->where('consignee_alias', $value)->first();
        if($addresslog_where){
            if($addresslog_where->consignee_alias  == $value){
                return true;
            }
        } else{
            foreach ($addresslogs as $addresslog)
            {

                if($addresslog->consignee_alias == $value){
                    return false;
                }
            }
        }


        return  true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
