<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $table = 'packages';

    protected $fillable = [
        'nama_paket',
        'slug',
        'destinasi',
        'kategori',
        'durasi',
        'makan',
        'deskripsi',
        'harga',
        'harga_display',
        'gambar',
        'itinerary',
        'is_active',
        'created_by',
    ];

    /**
     * Cast itinerary ke array otomatis (disimpan sebagai JSON di DB).
     */
    protected $casts = [
        'itinerary'  => 'array',
        'is_active'  => 'boolean',
        'harga'      => 'decimal:2',
    ];

    /**
     * Auto-generate slug dari nama_paket jika belum ada.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Package $package) {
            if (empty($package->slug)) {
                $package->slug = Str::slug($package->nama_paket) ?: 'paket-' . now()->timestamp;
            }
        });
    }

    /**
     * Relasi ke User yang membuat paket ini.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'package_id');
    }

    /**
     * Scope: hanya paket aktif.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor: URL gambar lengkap.
     */
    public function getGambarUrlAttribute(): string
    {
        if (!$this->gambar) {
            return asset('images/jogja.jpg');
        }
        if (str_starts_with($this->gambar, 'http://') || str_starts_with($this->gambar, 'https://')) {
            return $this->gambar;
        }
        if (str_starts_with($this->gambar, 'images/')) {
            return asset($this->gambar);
        }
        if (str_starts_with($this->gambar, 'storage/')) {
            return asset($this->gambar);
        }
        return asset('storage/' . ltrim($this->gambar, '/'));
    }

    /**
     * Accessor: Format tampilan harga.
     */
    public function getFormattedHargaAttribute(): string
    {
        if (!empty($this->harga_display)) {
            return $this->harga_display;
        }
        return 'Rp.' . number_format((float) ($this->harga ?? 0), 0, ',', '.');
    }
}
