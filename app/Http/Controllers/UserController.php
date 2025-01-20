<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Follow user
    public function follow(Request $request, User $user)
    {
        $currentUser = User::find(Auth::id());

        // Check if already following
        if ($currentUser->isFollowing($user)) {
            return response()->json(['message' => 'You are already following this user.'], 400);
        }

        // Add follow
        $currentUser->followings()->attach($user->id);

        return response()->json(['message' => 'Successfully followed the user.']);
    }

    // Unfollow user
    public function unfollow(Request $request, User $user)
    {
        $currentUser = User::find(Auth::id());

        // Check if already not following
        if (!$currentUser->isFollowing($user)) {
            return response()->json(['message' => 'You are not following this user.'], 400);
        }

        // Remove follow
        $currentUser->followings()->detach($user->id);

        return response()->json(['message' => 'Successfully unfollowed the user.']);
    }
}
