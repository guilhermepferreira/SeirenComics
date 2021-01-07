<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    protected $fillable=[
      'title',
      'subtitle',
      'edition',
      'arch',
      'total_arch',
      'draftsman',
      'colorist',
      'reviewer',
      'description',
      'path',
      'views',
      'rating',
      'series',
      'status',
      'changer',
      'comments',
      'pages',
      'comic_type_id',
      'old_id',
      'category',
    ];

    protected $hidden = [
        'path',
        'status',
        'changer',
        'comic_type_id',
        'old_id',
        'category',
        'created_at',
        'updated_at',
    ];

    public function type()
    {
        return $this->belongsTo(ComicType::class, 'comic_type_id', 'id');
    }

    public function traductions()
    {
        return $this->hasMany(ComicTraduction::class, 'comic_id', 'id');
    }
}
