<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update user details
        $user->fill($request->validated());

        // Reset email verification if email is updated
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Handle avatar upload
        if ($request->filled('cropped_avatar')) {
            $croppedData = $request->input('cropped_avatar'); // Ambil data Base64
            $avatarName = time() . '-' . uniqid() . '.webp'; // Nama unik untuk avatar
            $avatarFolder = public_path('avatars'); // Lokasi folder avatar
            $avatarPath = $avatarFolder . '/' . $avatarName; // Lokasi lengkap untuk menyimpan avatar

            // Buat folder jika belum ada
            if (!is_dir($avatarFolder)) {
                mkdir($avatarFolder, 0755, true);
            }

            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            // Decode dan simpan file dari Base64
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedData));
            file_put_contents($avatarPath, $imageData);

            // Simpan path relatif ke database
            $user->avatar = 'avatars/' . $avatarName;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function bankAccount()
    {
        return view('profile.bank-account');
    }

    public function rank()
    {
        return view('profile.rank');
    }

    public function verification()
    {
        return view('profile.verification');
    }
}
