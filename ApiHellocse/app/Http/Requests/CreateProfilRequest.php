<?php

namespace App\Http\Requests;

use App\Models\Profil;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class CreateProfilRequest extends FormRequest
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
            'nom' => [
                "required", 
                "min:2", 
                "max:255", 
                "regex:/^[a-zA-Z\-]+$/",
                Rule::unique(Profil::class)
            ],
            'prenom' => [
                "required", 
                "min:2",
                "max:255",
                "regex:/^[a-zA-Z\-]+$/",
                Rule::unique(Profil::class)
            ],
            'image' => [
                File::types(['png', 'jpg', 'jpeg'])->max('2mb')
            ],
            // 'status' => [
            //     "required",
            //     Rule::enum(Profil::class)->only([Profil::PROFILE_STATE_ACTIVE, Profil::PROFILE_STATE_AWAITING, Profil::PROFILE_STATE_INACTIVE])
            // ]
        ];
    }
}
