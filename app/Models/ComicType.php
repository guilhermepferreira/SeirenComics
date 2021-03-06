<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComicType extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'name',
      'short_name',
      'created_at',
      'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function comics()
    {
        return $this->hasMany(Comic::class, 'comic_type_id', 'id');
    }
}
