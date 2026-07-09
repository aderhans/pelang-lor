<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TtdSetting extends Model
{
    use HasFactory;

    protected $table = 'ttd_settings';

    protected $fillable = [
        'jabatan_key',
        'nama_pejabat',
        'jabatan_label',
        'path_ttd',
        'path_stempel',
    ];
}
