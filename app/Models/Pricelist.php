<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pricelist extends Model
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
            'aktif'  => 'boolean',
            'urutan' => 'integer',
            'harga'  => 'decimal:2',
            'durasi' => 'integer',
        ];
    }

    /**
     * Scope a query to only include active records, ordered by urutan.
     */
    public function scopeAktif($query)
    {
        return $query->where('aktif', true)->orderBy('urutan');
    }

    /**
     * Get formatted harga with Rupiah prefix.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get formatted durasi.
     */
    public function getDurasiFormatAttribute(): ?string
    {
        if (!$this->durasi) return null;

        if ($this->durasi >= 60) {
            $jam   = intdiv($this->durasi, 60);
            $menit = $this->durasi % 60;
            return $menit > 0 ? "{$jam} jam {$menit} menit" : "{$jam} jam";
        }

        return "{$this->durasi} menit";
    }
}
