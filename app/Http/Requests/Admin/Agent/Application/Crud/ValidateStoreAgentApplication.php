<?php

namespace App\Http\Requests\Admin\Agent\Application\Crud;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class ValidateStoreAgentApplication extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'mobile_number' => 'required|string|unique:agent_applications,mobile_number',
            'email' => 'required|email|max:255|unique:agent_applications,email',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'address' => 'required|string|min:5|max:255',
        ];
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
