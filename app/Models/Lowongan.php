<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';

    protected $fillable = [
        'posisi',
        'perusahaan',
        'lokasi',
        'kategori',
        'tipe_kerja',
        'pengaturan_kerja',
        'level',
        'gaji_min',
        'gaji_max',
        'deskripsi',
        'gambar',
    ];

    /** Tampilkan rentang gaji yang rapi, mis. "Rp 5jt - 8jt" */
    public function getGajiFormatAttribute(): string
    {
        if (! $this->gaji_min && ! $this->gaji_max) {
            return 'Gaji dirahasiakan';
        }

        $fmt = fn ($n) => 'Rp ' . number_format($n, 0, ',', '.');

        if ($this->gaji_min && $this->gaji_max) {
            return $fmt($this->gaji_min) . ' - ' . number_format($this->gaji_max, 0, ',', '.');
        }

        return $fmt($this->gaji_min ?: $this->gaji_max);
    }

    /** Inisial perusahaan untuk avatar logo */
    public function getInisialAttribute(): string
    {
        $nama = $this->perusahaan ?: $this->posisi;
        $kata = preg_split('/\s+/', trim($nama));
        $inisial = mb_substr($kata[0] ?? '', 0, 1);
        if (count($kata) > 1) {
            $inisial .= mb_substr($kata[1], 0, 1);
        }

        return mb_strtoupper($inisial);
    }

    public function getDipostingAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
