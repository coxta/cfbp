<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Cache;
use App\Models\RecordType;
use App\Models\Member;

trait GroupTrait
{

    public function type()
    {
        return $this->belongsTo(RecordType::class);
    }

    public static function typeId($name)
    {
        return Cache::remember('group:type:' . strtolower($name), 3600, function () use($name) {
            return RecordType::where('model', 'Group')->where('name', $name)->first()->id;
        });
    }

    public function scopePublic(Builder $query): void
    {
        $query->where('type_id', $this->typeId('Public'));
    }

    public function scopePrivate(Builder $query): void
    {
        $query->where('type_id', $this->typeId('Private'));
    }

    public function scopeMaster(Builder $query): void
    {
        $query->where('type_id', $this->typeId('Master'));
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }

}