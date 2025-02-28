<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WhatsappController;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function registerWhatsapp(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
        ], [
            'phone.required' => 'Nomor Whatsapp wajib diisi.',
            'phone.string' => 'Nomor Whatsapp harus berupa angka.',
            'phone.max' => 'Nomor Whatsapp tidak boleh lebih dari 255 karakter.',
            'phone.unique' => 'Nomor Whatsapp ini sudah digunakan.',
        ]);

        $code = hexdec(substr(md5($request->phone), 0, 8)) % 10000;

        try {
            $message = "Salam! Please input code: '{$code}' to validate your account.";

            app(WhatsappController::class)->sendNotification($message, $request->phone);
        } catch (\Exception $e) {
            Log::error('WhatsApp notification failed: ' . $e->getMessage());
        }

        return redirect()->route('validate.whatsapp', $request->phone);
    }

    public function validateWhatsapp(string $whatsapp)
    {
        $code = hexdec(substr(md5($whatsapp), 0, 8)) % 10000;
        return view('auth.validate-whatsapp', compact('code', 'whatsapp'));
    }

    public function verifyWhatsapp(Request $request, string $whatsapp)
    {
        $code = hexdec(substr(md5($whatsapp), 0, 8)) % 10000;
        if ($request->code == $code) {
            $user = User::create([
                'phone' => $whatsapp,
            ]);

            event(new Registered($user));

            Auth::login($user);
            Notification::create([
                'user_id' => $user->id,
                'link' => '/profile',
                'title' => 'Selamat datang! 🎉',
                'message' => 'Lengkapi profil kamu dan mulai menulis sekarang.',
            ]);

            return redirect()->route('play.dare.create')->with('success', 'Please complete your profile below.');
        }

        return redirect()->back()->with('error', 'Confirmation code is wrong!');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'referral_code' => ['nullable', 'exists:users,referral_code'], // Validasi kode referral
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            'phone.required' => 'Nomor telepon wajib diisi.',
            'phone.string' => 'Nomor telepon harus berupa angka.',
            'phone.max' => 'Nomor telepon tidak boleh lebih dari 255 karakter.',
            'phone.unique' => 'Nomor Whatsapp ini sudah digunakan.',
            'username.unique' => 'Username ini sudah digunakan.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'referral_code.exists' => 'Kode referral tidak valid.',
        ]);

        // Cari user yang memiliki kode referral (jika ada)
        $inviter = User::where('referral_code', $request->referral_code)->first();

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $this->generateReferralCode($request->username), // Buat kode referral unik
            'invited_by' => $inviter?->id, // Simpan ID user yang mengundang
        ]);

        event(new Registered($user));

        Auth::login($user);
        Notification::create([
            'user_id' => $user->id,
            'link' => '/profile',
            'title' => 'Selamat datang! 🎉',
            'message' => 'Lengkapi profil kamu dan mulai menulis sekarang.',
        ]);

        return redirect(route('dashboard'));
    }

    public function registerUpdate(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'referral_code' => $this->generateReferralCode($request->username),
        ]);

        return redirect()->route('play.dare.store');
    }

    /**
     * Generate a unique referral code.
     */
    private function generateReferralCode($username): string
    {
        do {
            $prefix = strtoupper(substr($username, 0, 5));
            $randomNumber = rand(100, 999);
            $code = $prefix . $randomNumber;
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }


    public function validateReferral(Request $request)
    {
        $request->validate([
            'referral_code' => ['required', 'exists:users,referral_code'],
        ], [
            'referral_code.required' => 'Kode referral wajib diisi.',
            'referral_code.exists' => 'Kode referral tidak valid.',
        ]);

        $inviter = User::where('referral_code', $request->referral_code)->first();

        session(['inviter' => $inviter]);

        return redirect()->route('register');
    }
}
