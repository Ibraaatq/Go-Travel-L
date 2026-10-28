<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
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
            return redirect('/login')->with('error', 'Silakan masuk terlebih dahulu.');
        }

        // Pastikan Auth::login dan session selalu sinkron
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

        // Validasi role resmi langsung dari database MySQL
        if ($user->role !== 'admin') {
            return redirect('/profile')->with('error', 'Akses ditolak. Halaman tersebut khusus untuk Administrator.');
        }

        return $next($request);
    }
}
