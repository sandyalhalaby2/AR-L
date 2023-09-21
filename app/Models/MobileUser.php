<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileUser extends Model
{
    use HasFactory;
    protected $table = 'mobile_users';

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'google_id' ,
        'email_verified_at' ,
        'profile_picture' ,
        'phone_number' ,
        'permission' ,
        'xp'
    ];

}
