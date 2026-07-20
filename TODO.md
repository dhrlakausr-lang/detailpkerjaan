- [x] Modifikasi ForgotPasswordController: pisahkan verifikasi OTP dari proses update password (tetap jaga session flow).
- [x] Modifikasi routes/web.php: buat route baru untuk verifikasi OTP dan update password setelah OTP valid.
- [x] Modifikasi reset-password.blade.php: pertahankan design; hanya ubah action/form handling agar sesuai 2 step (tanpa mengubah layout).
- [x] Ubah logic agar password hanya bisa disubmit setelah OTP diverifikasi; akses langsung step password harus ditolak/redirect.

- [ ] Test alur lengkap: minta OTP → verifikasi OTP salah/benar → update password.

