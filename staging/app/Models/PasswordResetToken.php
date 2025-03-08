<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $fillable = ['user_id','email', 'token'];

    public $timestamps = false;
    protected $table = 'password_reset_tokens';
}
