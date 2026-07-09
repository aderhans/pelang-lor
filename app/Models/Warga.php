<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Warga extends Authenticatable
{
    use Notifiable;

    protected $table    = 'wargas';
    protected $guard    = 'warga';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'email',
        'whatsapp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function surats()
    {
        return $this->hasMany(Surat::class);
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
