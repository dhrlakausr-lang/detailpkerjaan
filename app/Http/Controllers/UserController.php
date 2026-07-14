<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    // Proses Login
    public function prosesLogin(Request $request)
    {
        if (!$request->filled(['email', 'password'])) {
            return back()->with('error', 'Form tidak lengkap');
        }

        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        if (!password_verify($request->password, $user->password)) {
            return back()->with('error', 'Password salah 😹');
        }

        session([
            'user_id'  => $user->id,
            'username' => $user->username ?? $user->name ?? $user->email,
            'nama' => $user->nama ?? $user->name ?? $user->username ?? $user->email,
            'email' => $user->email,
            'role' => $user->role ?? 'user',
        ]);

        // Simpan Riwayat Login
        if (Schema::hasTable('login_history')) {
            DB::table('login_history')->insert([
                'user_id'    => $user->id,
                'ip_address' => $request->ip(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (($user->role ?? 'user') === 'hr') {
            return redirect()->route('admin.lamaran.index')->with('success', 'Login HR berhasil');
        }

        return redirect()->route('home')->with('success', 'Login berhasil 😹');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'username', 'nama', 'email', 'role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function register()
    {
        return view('register');
    }

    // Proses Register
    public function prosesRegister(Request $request)
    {
        $nama     = trim($request->nama);
        $username = trim($request->username);
        $email    = trim($request->email);
        $password = trim($request->password);
        $confirm  = trim($request->confirmPassword);
        $jenisLamaran = trim((string) $request->jenis_lamaran);

        if (
            empty($nama) ||
            empty($username) ||
            empty($email) ||
            empty($password) ||
            empty($confirm)
        ) {
            return back()->with('error', 'Semua form wajib diisi');
        }

        if ($password !== $confirm) {
            return back()->with('error', 'Password tidak sama');
        }

        $cek = DB::table('users')
            ->where('email', $email)
            ->exists();

        if ($cek) {
            return back()->with('error', 'Email sudah terdaftar 😹');
        }

        $data = [
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Schema::hasColumn('users', 'role')) {
            $data['role'] = 'user';
        }

        if (Schema::hasColumn('users', 'jenis_lamaran')) {
            $data['jenis_lamaran'] = $jenisLamaran ?: null;
        }

        if (Schema::hasColumn('users', 'nama')) {
            $data['nama'] = $nama;
        }

        if (Schema::hasColumn('users', 'username')) {
            $data['username'] = $username;
        }

        if (Schema::hasColumn('users', 'name')) {
            $data['name'] = $nama ?: $username;
        }

        DB::table('users')->insert($data);

        return redirect('/login')->with('success', 'Registrasi berhasil 😹');
    }
}
