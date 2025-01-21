<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($this->user()->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'phone' => [
                'required',
                'string',
                'max:15',
                Rule::unique('users', 'phone')->ignore($this->user()->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'string', 'max:255'], // Avatar biasanya berupa URL
            'bio' => ['nullable', 'string', 'max:1000'], // Bio memiliki batas panjang yang wajar
            'referral_code' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('users', 'referral_code')->ignore($this->user()->id),
            ],
            'role' => ['nullable', 'in:user,admin'], // Validasi untuk enum role
            'invited_by' => ['nullable', 'exists:users,id'], // Validasi jika `invited_by` digunakan
            'referral_quota' => ['nullable', 'integer', 'min:0'], // Validasi kuota referral
            'rank' => ['nullable', 'string', 'max:255'], // Rank sebagai string
            'xp' => ['nullable', 'integer', 'min:0'], // XP sebagai angka positif
            'is_verified' => ['nullable', 'boolean'], // Boolean untuk verifikasi
        ];
    }
}
