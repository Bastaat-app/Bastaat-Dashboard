<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Modules\Core\HTTPResponseCodes;
class PlaceEditRequest extends FormRequest
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
        $data= request()->all();
       $vendor_id=$data['vendor_id'];
       $id=$data['id'];
        return [
            'name' => 'required',
            'footer_text' => 'required',
            'address' => 'required',
            'delivery_charge' => 'required|numeric',
            'compilation_id' => 'required|numeric|exists:compilations,id',
            'opening_time' => 'required',
            'closeing_time' => 'required',
            'delivery_time_from' => 'required',
            'delivery_time_to' => 'required',
            'zone_id' => 'required|numeric|exists:zones,id',
            'latitude' => 'required',
            'longitude' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required|unique:vendors,phone,'.$vendor_id.',id,deleted_at,NULL',
            'email'=> 'required|email|unique:vendors,email,'.$vendor_id.',id,deleted_at,NULL',
            'image'=>'sometimes|required|array',
           'image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'cover_photo'=>'sometimes|required|array',
           'cover_photo.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'password' => 'nullable|min:6|required_with:confirm_password|same:confirm_password',
          'confirm_password' => 'nullable|min:6'
        ];

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'footer_text.required' => 'footer_text is required',
            'address.required' => 'address is required',
            'delivery_charge.required' => 'delivery_charge is required',
            'compilation_id.required' => 'compilation_id is required',
            'opening_time.required' => 'opening_time is required',
            'closeing_time.required' => 'closeing_time is required',
            'delivery_time_from.required' => 'delivery_time_from is required',
            'delivery_time_to.required' => 'delivery_time_to is required',
            'zone_id.required' => 'zone_id is required',
            'latitude.required' => 'latitude is required',
            'longitude.required' => 'longitude is required',
            'f_name.required' => 'f_name is required',
            'l_name.required' => 'l_name is required',
            'phone.required' => 'phone is required',
            'email.required' => 'email is required',
            'image.required' => 'image is required',
            'cover_photo.required' => 'cover_photo is required',
            'password.required' => 'password is required',
            'confirm_password.required' => 'confirm_password is required'
        ];
    }


}
