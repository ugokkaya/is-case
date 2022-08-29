<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Products;

class OrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customerId'            => 'required|exists:customers,id',
            'items'                 => 'required|array',
            'items.*'               => function($attribute, $value, $fail) {
                                        if(!isset($value['productId'])){
                                            $fail($attribute. ' is invalid');
                                            return;
                                        }

                                        if(!is_numeric($value['productId'])){
                                            $fail($attribute. ' is not numeric');
                                            return;
                                        }
                                       
                                        if(!ctype_digit($value['quantity'])){
                                            $fail($attribute. ' is not integer');
                                            return;
                                        }
                                       
                                        $stock =  Products::where('id', '=', $value['productId'])->pluck('stock');
                                        if(!isset($stock[0])){
                                            $fail($attribute. ' product not exists');
                                            return;
                                        }
                                        
                                        if($stock[0] < $value['quantity']){
                                            $fail($attribute. ' stock not found');
                                            return;
                                        }
                                     },
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' =>$validator->errors(),
        ], 422));
    }
}
