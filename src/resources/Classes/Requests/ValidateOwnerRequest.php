<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateOwnerRequest extends FormRequest
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
        $owner = $this->route('owner');
        $name = 'required|max:50|unique:owners,name';
        $fiscalCode = 'nullable|unique:owners,fiscal_code';
        $regComNr = 'nullable|unique:owners,reg_com_nr';
        $email = 'nullable|email|unique:owners,email';
        $phone = 'nullable';

        if ($this->_method == 'PATCH') {
            $name .= ','.$owner->id.',id';
            $fiscalCode .= ','.$owner->id.',id';
            $regComNr .= ','.$owner->id.',id';
            $email .= ','.$owner->id.',id';
        }

        return [
            'name'          => $name,
            'email'         => $email,
            'phone'         => $phone,
            'fiscal_code'   => $fiscalCode,
            'reg_com_nr'    => $regComNr,
            // 'is_individual' => 'required|in:"1","0"',
            'is_active'     => 'required|in:"1","0"',
        ];
    }
}
