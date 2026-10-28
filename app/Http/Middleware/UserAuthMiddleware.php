<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class UserAuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::id() ?? session('user.id');
        $userEmail = Auth::user()?->email ?? session('user.email');

        $user = null;
        if ($userId) {
            $user = User::find($userId);
        } elseif ($userEmail) {
            $user = User::where('email', $userEmail)->first();
        }

        if (!$user) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Silakan masuk terlebih dahulu.'], 401);
            }
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        if (!Auth::check()) {
            Auth::login($user);
        }

        if (!session()->has('user')) {
            session([
                'user' => [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'email'    => $user->email,
                    'avatar'   => $user->avatar ?: '',
                    'provider' => $user->provider ?: 'local',
                    'role'     => $user->role ?? 'user',
                    'phone'    => $user->phone ?? '',
                ]
            ]);
        }

        return $next($request);
    }
}
