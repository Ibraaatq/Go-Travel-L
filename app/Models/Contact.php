<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'message',
        'nama_lengkap',
        'nomor_telepon',
        'pesan',
    ];

    /**
     * Otomatis sinkronisasi kolom name/phone/message dengan nama_lengkap/nomor_telepon/pesan
     */
    protected static function booted(): void
    {
        static::saving(function ($contact) {
            if (!empty($contact->name) && empty($contact->nama_lengkap)) {
                $contact->nama_lengkap = $contact->name;
            } elseif (!empty($contact->nama_lengkap) && empty($contact->name)) {
                $contact->name = $contact->nama_lengkap;
            }

            if (!empty($contact->phone) && empty($contact->nomor_telepon)) {
                $contact->nomor_telepon = $contact->phone;
            } elseif (!empty($contact->nomor_telepon) && empty($contact->phone)) {
                $contact->phone = $contact->nomor_telepon;
            }

            if (!empty($contact->message) && empty($contact->pesan)) {
                $contact->pesan = $contact->message;
            } elseif (!empty($contact->pesan) && empty($contact->message)) {
                $contact->message = $contact->pesan;
            }
        });
    }
}
