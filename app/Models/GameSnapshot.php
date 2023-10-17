<?php

namespace App\Models;

use App\Models\Traits\GameSnapshotTrait;

use Illuminate\Database\Eloquent\Model;

class GameSnapshot extends Model
{
    use GameSnapshotTrait;

    protected $table = 'game_snapshots';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;

    protected $guarded= [];

    protected $casts = [
        'venue' => 'array',
        'home_lines' => 'array',
        'away_lines' => 'array',
        'notes' => 'array',
        'situation' => 'array',
        'leaders' => 'array',
        'broadcasts' => 'array',
        'home_records' => 'array',
        'away_records' => 'array',
    ];
}