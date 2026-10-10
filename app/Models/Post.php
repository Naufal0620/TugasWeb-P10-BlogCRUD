<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    // Hanya kolom yang terdaftar di $fillable yang boleh diisi via Form / Request
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'stock',
    ];

    // Event Hook: Otomatis hapus file fisik gambar di storage saat record dihapus permanen
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            if ($post->isForceDeleting() && $post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }
        });
    }
}
