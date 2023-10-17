<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use Uuid;

    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;

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