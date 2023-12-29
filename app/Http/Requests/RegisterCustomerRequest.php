<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\RegionCommuneRule;

class RegisterCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'dni' => 'required|string|max:45',
            'id_reg' => ['required', 'integer', 'exists:regions,id_reg'],
            'id_com' => ['required', 'integer', 'exists:communes,id_com',
                new RegionCommuneRule($this->id_reg),
            ],
            'email' => 'required|email|max:120|unique:customers,email',
            'name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address' => 'nullable|string|max:255',
        ];
    }
}
