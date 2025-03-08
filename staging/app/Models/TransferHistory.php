<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferHistory extends Model
{
    use HasFactory;

    protected $table = 'transfer_history';
    protected $primaryKey = 'id';
    public $timestamps = false; // Karena kita hanya pakai kolom `created`

    protected $fillable = [
        'user_id',
        'transfer_amount',
        'acc_name',
        'acc_number',
        'created',
        'created_by'
    ];

    protected $casts = [
        'transfer_amount' => 'decimal:2',
        'created' => 'datetime',
    ];
}
