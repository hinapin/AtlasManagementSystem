<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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

     public function getValidatorInstance() {
        //生年月日をまとめて値に直す

        $old_year = $this->input('old_year');
        $old_month = $this->input('old_month');
        $old_day = $this->input('old_day');
        $datetime = $old_year .'-'. $old_month .'-'. $old_day;

        // rules()に渡す値を追加でセット
        //これで、この場で作った変数にもバリデーションを設定できるようになる
        $this->merge([
            'datetime_validation' => $datetime,
        ]);

        return parent::getValidatorInstance();
        //ここで定義した変数はここでしか使えないようにしている(parentで返しているのがこのメソッドだから)
    }


    public function rules()
    {
        return [
                'over_name' => 'required|string|max:10',
                'under_name' => 'required|string|max:10',
                'over_name_kana' => 'required|string|regex:/^[ァ-ヶ　]+$/u|max:30',
                'under_name_kana' => 'required|string|regex:/^[ァ-ヶ　]+$/u|max:30',
                'mail_address' => 'required|unique:users|email:rfc|max:100',
                'sex' => 'required',
                'datetime_validation' => 'required|date|after_or_equal:2000-01-01',
                'role' => 'required',
                'password' => 'required|confirmed|min:8|max:30',
        ];
    }


}
