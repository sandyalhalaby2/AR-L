<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'email',
        'password',
        'phone_number'
    ];

    public function updatePassword($newPassword)
    {
        $this->password = Hash::make($newPassword);
        $this->save();
    }

    public function delete()
    {
        if ($this->image != null) {
            $imagePath = str_replace('/storage', '', parse_url($this->image, PHP_URL_PATH));
            Storage::delete($imagePath);
        }
        parent::delete() ;
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class ,'user_id' ) ;
    }

    public function favoriteCourse(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'favorites', 'user_id', 'course_id');
    }

    public function isCourseFavorite(Course $course)
    {
        return $this->favorites()->where('course_id', $course->id)->exists();
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
