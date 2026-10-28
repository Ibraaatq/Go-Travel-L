<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Throwable;

class SocialiteController extends Controller
{
    /**
     * Redirect pengguna ke halaman autentikasi OAuth Google.
     */
    public function redirectToGoogle()
    {
        $clientId = config('services.google.client_id');
        $clientSecret = config('services.google.client_secret');

        if (empty($clientId) || empty($clientSecret)) {
            return redirect()->route('login')->with(
                'error',
                'Konfigurasi OAuth Google belum lengkap di server (.env). Harap periksa GOOGLE_CLIENT_ID dan GOOGLE_CLIENT_SECRET.'
            );
        }

        try {
            return Socialite::driver('google')->redirect();
        } catch (Throwable $e) {
            Log::error('Google OAuth Redirect Error: ' . $e->getMessage());
            return redirect()->route('login')->with(
                'error',
                'Gagal menginisialisasi login Google: ' . $e->getMessage()
            );
        }
    }

    /**
     * Tangani callback OAuth dari Google setelah pengguna berhasil/batal diautentikasi.
     */
    public function handleGoogleCallback(Request $request)
    {
        // Cek jika pengguna membatalkan login di halaman Google
        if ($request->has('error')) {
            $errorDesc = $request->input('error_description') ?: 'Autentikasi Google dibatalkan atau ditolak.';
            return redirect()->route('login')->with('error', $errorDesc);
        }

        try {
            /** @var SocialiteUser $googleUser */
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $e) {
            Log::error('Google OAuth Callback Error: ' . $e->getMessage());
            return redirect()->route('login')->with(
                'error',
                'Autentikasi Google gagal atau sesi telah kedaluwarsa. Silakan coba kembali.'
            );
        }

        if (!$googleUser || empty($googleUser->getEmail())) {
            return redirect()->route('login')->with(
                'error',
                'Data akun Google tidak valid atau email tidak dapat diakses.'
            );
        }

        $user = $this->findOrCreateSocialUser($googleUser, 'google');

        $this->loginUserSession($user, 'google', $googleUser->getAvatar());

        return redirect('/')->with('success', 'Selamat datang, ' . $user->name . '! Berhasil masuk dengan akun Google.');
    }

    /**
     * Cari atau daftarkan akun user di database berdasarkan identitas OAuth.
     */
    private function findOrCreateSocialUser(SocialiteUser $socialUser, string $provider, ?string $customEmail = null): User
    {
        $email = $customEmail ?: $socialUser->getEmail();
        $providerId = (string) $socialUser->getId();
        $avatar = $socialUser->getAvatar();
        $name = $socialUser->getName() ?: ($socialUser->getNickname() ?: 'Pengguna ' . ucfirst($provider));

        // 1. Cari user berdasarkan provider dan provider_id
        $user = User::where('provider', $provider)
            ->where('provider_id', $providerId)
            ->first();

        // 2. Jika belum cocok, cari berdasarkan email (menghubungkan akun yang sudah terdaftar via email/password)
        if (!$user && $email) {
            $user = User::where('email', $email)->first();
        }

        if ($user) {
            // Update data provider dan avatar jika belum ada
            $user->provider = $provider;
            $user->provider_id = $providerId;
            if ($avatar && empty($user->avatar)) {
                $user->avatar = $avatar;
            }
            $user->save();
            return $user;
        }

        // 3. Jika pengguna baru sama sekali, buat akun baru di database dengan role default 'user'
        return User::create([
            'name'        => $name,
            'email'       => $email,
            'password'    => null,
            'role'        => 'user',
            'provider'    => $provider,
            'provider_id' => $providerId,
            'avatar'      => $avatar,
        ]);
    }

    /**
     * Simpan sesi login user ke Laravel Auth dan session secara terstruktur.
     */
    private function loginUserSession(User $user, string $provider, ?string $avatar = null): void
    {
        Auth::login($user, true);
        request()->session()->regenerate();

        session([
            'user' => [
                'id'       => $user->id,
                'name'     => $user->name,
                'email'    => $user->email,
                'avatar'   => $avatar ?: ($user->avatar ?: ''),
                'provider' => $provider,
                'role'     => $user->role ?? 'user',
                'phone'    => $user->phone ?? '',
            ]
        ]);
    }
}
