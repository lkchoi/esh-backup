<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMatchRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_id' => 'required',
            // 'character_id' => 'required',
            'payout' => 'required|in:200,500,1000'
        ];
    }
}
