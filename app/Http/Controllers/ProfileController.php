<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'cropped_avatar' => 'nullable|string|regex:/^data:image\/\w+;base64,/',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->filled('email') && $user->email != $request->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        // Handle avatar upload (base64)
        if ($request->filled('cropped_avatar')) {
            $croppedData = $request->input('cropped_avatar');
            $avatarName = time() . '-' . uniqid() . '.webp';
            $avatarFolder = public_path('avatars');
            $avatarPath = $avatarFolder . '/' . $avatarName;

            if (!is_dir($avatarFolder)) {
                mkdir($avatarFolder, 0755, true);
            }

            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $croppedData));
            file_put_contents($avatarPath, $imageData);

            $user->avatar = 'avatars/' . $avatarName;
        }

        // Handle avatar upload (file)
        if ($request->hasFile('avatar')) {
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // Handle cover upload
        if ($request->hasFile('cover')) {
            if ($user->cover && file_exists(public_path($user->cover))) {
                unlink(public_path($user->cover));
            }
            $coverPath = $request->file('cover')->store('covers', 'public');
            $user->cover = $coverPath;
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
