<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_slug',
        'nama_paket',
        'kota_keberangkatan',
        'tanggal_keberangkatan',
        'titik_kumpul',
        'jumlah_peserta',
        'catatan',
        'nama_pemesan',
        'nomor_hp',
        'email_pemesan',
        'nama_instansi',
        'skema_pembayaran',
        'total_pembayaran',
        'status',
        'bukti_pembayaran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'paket_slug', 'slug');
    }
}
