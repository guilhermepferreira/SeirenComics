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
}
