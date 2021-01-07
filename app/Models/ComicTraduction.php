<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicTraduction extends Model
{
    use HasFactory;

    protected $fillable = [
        'comic_id',
        'language',
        'translated_name',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'comic_id',
        'created_at',
        'updated_at'
    ];
}
