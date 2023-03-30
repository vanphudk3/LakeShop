<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class admin extends Model
{
    use HasFactory;


    protected $fillable = [
        'admin_name',
        'admin_username',
        'admin_password',
    ];
    protected $table = 'admins';
}
