<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Team;
use App\Models\Group;

trait UserTrait
{

    public function isAdmin()
    {
        return $this->admin;
    }

    public function favorites()
    {
        return Team::whereIn('id', $this->teams)->get();
    }

    public function groups()
    {
        return Group::whereHas('members', function (Builder $query) {
            $query->where('user_id', $this->id);
        });
    }

}