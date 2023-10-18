<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class GameHist extends Model
{
    
    use HasUuids;

    public $table = 'games_hist';

}
