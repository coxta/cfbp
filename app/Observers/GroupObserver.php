<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\Member;
use Masmerise\Toaster\Toaster;

class GroupObserver
{
    /**
     * Handle the Group "created" event.
     */
    public function created(Group $group): void
    {
        Member::create([
            'group_id' => $group->id,
            'type_id' => Member::getTypeId('Commissioner'),
            'user_id' => $group->user_id
        ]);
        Toaster::success('Group created!');
    }

    /**
     * Handle the Group "updated" event.
     */
    public function updated(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "deleted" event.
     */
    public function deleted(Group $group): void
    {
        Toaster::info('Group deleted');
    }

    /**
     * Handle the Group "restored" event.
     */
    public function restored(Group $group): void
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     */
    public function forceDeleted(Group $group): void
    {
        //
    }
}
