<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Member;

trait GroupTrait
{

    public function scopePublic(Builder $query): void
    {
        $query->where('type_id', $this->getTypeId('Public'));
    }

    public function scopePrivate(Builder $query): void
    {
        $query->where('type_id', $this->getTypeId('Private'));
    }

    public function scopeMaster(Builder $query): void
    {
        $query->where('type_id', $this->getTypeId('Master'));
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

}