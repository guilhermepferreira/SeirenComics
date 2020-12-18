<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type_name',
        'short_name',
        'created_at',
        'updated_at',
    ];

    protected $hidden =[
        'created_at',
        'updated_at',
    ];


    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }
}
