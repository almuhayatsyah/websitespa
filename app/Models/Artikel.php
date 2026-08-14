<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasUuids;

    /**
     * Allow all fields to be mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'diterbitkan' => 'boolean',
            'tanggal_terbit' => 'datetime',
        ];
    }

    /**
     * Auto-generate slug from judul when saving.
     */
    protected static function booted(): void
    {
        static::creating(function (Artikel $artikel) {
            if (empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
        });

        static::updating(function (Artikel $artikel) {
            if ($artikel->isDirty('judul') && empty($artikel->slug)) {
                $artikel->slug = Str::slug($artikel->judul);
            }
        });
    }

    /**
     * Scope a query to only include published articles.
     */
    public function scopeDiterbitkan($query)
    {
        return $query->where('diterbitkan', true)
                     ->whereNotNull('tanggal_terbit')
                     ->where('tanggal_terbit', '<=', now())
                     ->orderByDesc('tanggal_terbit');
    }

    /**
     * Get the route key for the model (slug for frontend).
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
