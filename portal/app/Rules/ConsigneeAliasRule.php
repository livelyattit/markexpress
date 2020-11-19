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
    private $addresslog_id;
    public function __construct($addresslog_id)
    {
        $this->addresslog_id = $addresslog_id;
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
        $addresslog_where = Addresslog::find($this->addresslog_id);

        if($addresslog_where && $addresslog_where->consignee_alias  == $value ){

            return true;

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
        return 'Alias is already used in your address log.';
    }
}
