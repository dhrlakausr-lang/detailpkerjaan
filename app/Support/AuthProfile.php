<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuthProfile
{
    public static function current(): array
    {
        $displayName = session('nama', session('username', ''));
        $email = session('email', '');
        $role = session('role', 'user');

        if (session()->has('user_id') && Schema::hasTable('users')) {
            $user = DB::table('users')->where('id', session('user_id'))->first();

            if ($user) {
                $displayName = $user->nama ?? $user->name ?? $user->username ?? $displayName;
                $email = $user->email ?? $email;
                $role = $user->role ?? $role;
            }
        }

        return [
            'id' => session('user_id'),
            'name' => $displayName,
            'email' => $email,
            'role' => $role,
            'initial' => $displayName !== '' ? strtoupper(substr($displayName, 0, 1)) : 'U',
            'logged_in' => session()->has('user_id') && $displayName !== '',
        ];
    }
}
