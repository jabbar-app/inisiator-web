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

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah digunakan, coba yang lain.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan, coba yang lain.',

            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa teks.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
            'phone.unique' => 'Nomor telepon sudah digunakan, coba yang lain.',

            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',

            'avatar.string' => 'Avatar harus berupa URL.',
            'avatar.max' => 'Avatar tidak boleh lebih dari 255 karakter.',

            'bio.string' => 'Bio harus berupa teks.',
            'bio.max' => 'Bio tidak boleh lebih dari 1000 karakter.',

            'referral_code.string' => 'Kode referral harus berupa teks.',
            'referral_code.max' => 'Kode referral tidak boleh lebih dari 255 karakter.',
            'referral_code.unique' => 'Kode referral sudah digunakan, coba yang lain.',

            'role.in' => 'Role harus bernilai user atau admin.',

            'invited_by.exists' => 'ID pengundang tidak valid.',

            'referral_quota.integer' => 'Kuota referral harus berupa angka.',
            'referral_quota.min' => 'Kuota referral tidak boleh kurang dari 0.',

            'rank.string' => 'Rank harus berupa teks.',
            'rank.max' => 'Rank tidak boleh lebih dari 255 karakter.',

            'xp.integer' => 'XP harus berupa angka.',
            'xp.min' => 'XP tidak boleh kurang dari 0.',

            'is_verified.boolean' => 'Verifikasi harus bernilai true atau false.',
        ];
    }
}
