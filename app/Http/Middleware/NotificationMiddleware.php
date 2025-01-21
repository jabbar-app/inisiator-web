<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class NotificationMiddleware
{
    public function handle($request, Closure $next)
    {
        $notifications = Auth::check()
            ? cache()->remember('notifications_' . Auth::id(), 60, function () {
                return User::find(Auth::id())->notifications()->latest()->limit(10)->get();
            })
            : collect();

        view()->share('notifications', $notifications);

        return $next($request);
    }
}
