<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Modules\Core\HTTPResponseCodes;
class CouponRequest extends FormRequest
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
       /* $data= request()->all();
        $vendor_id=$data['vendor_id'];
        $id=$data['id'];*/
        return [
            'title' => 'required',
            'code' => 'required',
            'restaurant_id' => 'required|numeric|exists:restaurants,id',
            'compilation_id' => 'required|numeric|exists:compilations,id',
            'start_date' => 'required',
            'discount_type' => 'required',
            'expire_date' => 'required',
            'discount' => 'required',
            'min_purchase' => 'required',


        ];

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
   /* public function messages()
    {
        return [

        ];
    }*/


}
