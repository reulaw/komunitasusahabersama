<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel dalam database

    protected $primaryKey = 'id'; // Primary Key

    public $timestamps = false; // Aktifkan timestamps (created_at & updated_at)

    protected $fillable = [
        'user_id',
        'password',
        'referral_code',
        'is_admin',
        'is_paid',
        'nama',
        'nik',
        'wa_number',
        'email',
        'bank_name',
        'acc_number',
        'acc_name',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_admin' => 'string',
        'is_paid' => 'string',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    /**
     * Set Password: Hash otomatis saat disimpan
     */
    // protected function password(): Attribute
    // {
    //     return Attribute::make(
    //         set: fn ($value) => bcrypt($value)
    //     );
    // }

    // public function getAuthIdentifierName()
    // {
    //     return 'user_id';
    // }
}
