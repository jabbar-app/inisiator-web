<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function earning()
    {
        return $this->hasOne(WriterEarning::class);
    }

    // Relasi untuk daftar yang diikuti oleh user
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'user_id');
    }

    // Relasi untuk daftar followers user
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_followers', 'user_id', 'follower_id');
    }

    // Check apakah user mengikuti user lain
    public function isFollowing(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    // Check apakah user diikuti oleh user lain
    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
