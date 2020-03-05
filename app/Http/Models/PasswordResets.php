<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    protected $table = 'password_resets';

    protected $fillable = ['email', 'token'];
}
