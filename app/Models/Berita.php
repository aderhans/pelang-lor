<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'slug', 'ringkasan', 'isi',
        'gambar', 'tanggal', 'is_published',
    ];

    protected $casts = [
        'tanggal'      => 'date',
        'is_published' => 'boolean',
    ];

    /**
     * Auto-generate slug dari judul jika belum ada.
     */
    public static function generateSlug(string $judul, ?int $exceptId = null): string
    {
        $base = Str::slug($judul);
        $slug = $base;
        $i    = 1;

        while (
            static::where('slug', $slug)
                ->when($exceptId, fn($q) => $q->where('id', '!=', $exceptId))
                ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    /**
     * Scope: hanya berita yang sudah dipublish.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('tanggal', 'desc');
    }
}
