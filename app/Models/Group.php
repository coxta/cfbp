<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\GroupTrait;
use App\Models\Member;

class Group extends Model
{
    use HasUuids, GroupTrait;

    protected $fillable = [
        'name',
        'type_id',
        'user_id'
    ];

    protected $casts = [
        'options' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (Group $group) {

            // Always create the commissioner member when a group is created
            Member::create([
                'group_id' => $group->id,
                'type_id' => RecordType::where('model','Member')->where('name', 'Commissioner')->first()->id,
                'user_id' => $group->user_id
            ]);
        });
    }
}
