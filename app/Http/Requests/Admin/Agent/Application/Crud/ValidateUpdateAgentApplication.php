<?php

namespace App\Http\Requests\Admin\Agent\Application\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class ValidateUpdateAgentApplication extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function message() : array
    {
        return [
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules($request,$row): array
    {
        $rules =  [
            'name' => 'required|string|min:2|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'required|string|min:5|max:255',
        ];
        if($row->isDirty('email')) {
            $rules['email'] = 'required|string|max:253|unique:agent_applications,email';
        }
        if($row->isDirty('mobile_number')) {
            $rules['mobile_number'] = 'required|string|max:253|unique:agent_applications,mobile_number';
        }
        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'errors'  => $validator->errors(),
        ]);
        throw (new ValidationException($validator, $response))->errorBag($this->errorBag);
    }
}
