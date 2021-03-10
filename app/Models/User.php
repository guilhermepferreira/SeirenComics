<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Billable, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'id',
        'user_type_id',
        'name',
        'email',
        'status',
        'is_active',
        'nickname',
        'password',
        'license_start',
        'license_end',
        'google_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
        'license_start',
        'license_end',
        'created_at',
        'updated_at'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function favorites(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserComic::class);
    }
    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(UserType::class,'user_type_id','id');
    }
}
