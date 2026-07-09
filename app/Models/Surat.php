<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'warga_id',
        'nomor_surat', 'jenis_surat', 'nama', 'nik', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'kewarganegaraan', 'agama',
        'pekerjaan', 'alamat', 'keperluan', 'tanggal_surat', 'status'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}
