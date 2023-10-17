<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use HasUuids;

    protected $fillable = [
        'espn_id',
        'article_type',
        'link',
        'image',
        'game_id',
        'headline',
        'description',
        'story',
        'published'
    ];

    protected $casts = [
        'published' => 'datetime',
    ];

}