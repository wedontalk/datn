<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class thanhtoan extends FormRequest
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
            //
            'order_name'=>['required','min:3','max:20'],
            'id_thanhpho'=>['required'],
            'id_quanhuyen'=>['required'],
            'id_xaphuong'=>['required'],
            'order_address'=>['required'],
            'order_email'=>['required'],
            'order_phone'=>['required','min:10','max:11'],



        ];
    }
    public function messages() {
        return [
             'order_name.required' => 'Họ và Tên không được để trống!',
             'order_name.min' => 'Họ tên quá ngắn!',
             'order_name.max' => 'Họ và tên quá dài!',
             'id_thanhpho.required' => 'Hãy chọn tỉnh/thành phố!',
             'id_quanhuyen.required' => 'Hãy chọn quận/huyện!',    
             'id_xaphuong.required' => 'Hãy chọn xã/phường!',    
             'order_address.required' => 'Hãy nhập địa chỉ/số nhà!',
             'order_email.required' => 'Hãy nhập địa chỉ email!',
             'order_phone.required' => 'Hãy nhập số điện thoại!',


        ];
      }
      public function attributes(){
        return [
           'order_name' => 'Họ và tên',
           
       ];
     }
}
