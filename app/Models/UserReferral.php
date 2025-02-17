<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReferral extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'referral_mapping'; // Sesuaikan dengan nama tabel Anda

    /**
     * Kolom yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'referral_code',
    ];

    /**
     * Kolom yang harus disembunyikan saat serialisasi.
     *
     * @var array
     */
    protected $hidden = [
        // Jika ada kolom yang ingin disembunyikan, tambahkan di sini
    ];

    /**
     * Kolom yang secara otomatis di-cast ke tipe data tertentu.
     *
     * @var array
     */
    protected $casts = [
        'created' => 'datetime', // Cast created_at ke tipe datetime

    ];

    /**
     * Nonaktifkan timestamps (created_at dan updated_at).
     *
     * @var bool
     */
    public $timestamps = false; // Jika Anda tidak menggunakan kolom updated_at

    /**
     * Relasi ke model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id', 'id');
    // }
}