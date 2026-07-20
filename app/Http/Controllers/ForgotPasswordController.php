<?php

namespace App\Http\Controllers;

use App\Models\PelamarPasswordResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Throwable;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = strtolower(trim($request->email));
        $pelamar = $this->findPelamarByEmail($email);

        if (! $pelamar) {
            return back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar.');
        }

        $otp = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $otpHash = $this->hashOtp($email, $otp);
        $expiresAt = now()->addMinutes(10);

        PelamarPasswordResetToken::where('email', $email)->delete();
        PelamarPasswordResetToken::create([
            'email' => $email,
            'token_hash' => $otpHash,
            'expires_at' => $expiresAt,
        ]);

        try {
            Mail::send('emails.otp', ['otp' => $otp, 'email' => $email], function ($message) use ($email) {
                $message->to($email)->subject('Kode OTP Reset Password - LokerinAja');
            });
        } catch (Throwable $exception) {
            PelamarPasswordResetToken::where('token_hash', $otpHash)->delete();

            return back()
                ->withInput()
                ->with('error', 'Kode OTP gagal dikirim. Periksa konfigurasi email/SMTP.');
        }

        $request->session()->put('otp_email', $email);

        return redirect()
            ->route('password.reset')
            ->with('success', 'Kode OTP sudah dikirim ke email Anda. Cek inbox/spam.');
    }

    public function showResetForm(Request $request)
    {
        $email = $request->session()->get('otp_email');

        if (! $email) {
            return redirect()
                ->route('password.request')
                ->with('error', 'Silakan minta kode OTP terlebih dahulu.');
        }

        return view('reset-password', [
            'email' => $email,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $email = $request->session()->get('otp_email');

        if (! $email) {
            return redirect()
                ->route('password.request')
                ->with('error', 'Sesi berakhir. Silakan minta kode OTP baru.');
        }

        $request->validate([
            'otp' => ['required', 'digits:6'],
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.digits' => 'Kode OTP harus 6 digit angka.',
        ]);

        $record = PelamarPasswordResetToken::where('email', $email)
            ->where('expires_at', '>', now())
            ->first();

        if (! $record || ! hash_equals($record->token_hash, $this->hashOtp($email, $request->otp))) {
            return back()->with('error', 'Kode OTP salah atau sudah kedaluwarsa.');
        }

        // OTP only once
        $record->delete();

        $request->session()->put('otp_verified_email', $email);

        return redirect()
            ->route('password.reset')
            ->with('success', 'OTP berhasil diverifikasi. Silakan buat password baru.');
    }

    public function resetPassword(Request $request)
    {
        $email = $request->session()->get('otp_email');
        $verifiedEmail = $request->session()->get('otp_verified_email');

        if (! $email) {
            return redirect()
                ->route('password.request')
                ->with('error', 'Sesi berakhir. Silakan minta kode OTP baru.');
        }

        // Hanya bisa ubah password setelah OTP terverifikasi
        if (! $verifiedEmail || $verifiedEmail !== $email) {
            return back()->with('error', 'Silakan verifikasi OTP terlebih dahulu.');
        }

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $pelamar = $this->findPelamarByEmail($email);

        if (! $pelamar) {
            return redirect()
                ->route('login')
                ->with('error', 'Email tidak terdaftar.');
        }

        DB::table('users')
            ->where('id', $pelamar->id)
            ->update([
                'password' => bcrypt($request->password),
                'updated_at' => now(),
            ]);

        $request->session()->forget('otp_email');
        $request->session()->forget('otp_verified_email');

        return redirect()
            ->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }


    private function hashOtp(string $email, string $otp): string
    {
        return hash('sha256', $email . '|' . $otp);
    }

    private function findPelamarByEmail(string $email): ?object
    {
        $query = DB::table('users')->where('email', $email);

        if (Schema::hasColumn('users', 'role')) {
            $query->where(function ($roleQuery) {
                $roleQuery->whereNull('role')
                    ->orWhere('role', 'user')
                    ->orWhere('role', 'pelamar');
            });
        }

        return $query->first();
    }
}
