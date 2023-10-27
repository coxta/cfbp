<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\RecordType;

class RecordTypeObserver
{
    /**
     * Handle the RecordType "created" event.
     */
    public function created(RecordType $recordType): void
    {

        $modelKey = $recordType->model . ':' . $recordType->name . ':RecordType';
        $idKey = $recordType->model . ':' . $recordType->name . ':RecordTypeId';

        Cache::forget($modelKey);
        Cache::forget($idKey);
        Cache::put($modelKey, $recordType, now()->addDays(7));
        Cache::put($idKey, $recordType->id, now()->addDays(7));
        
    }

    /**
     * Handle the RecordType "updated" event.
     */
    public function updated(RecordType $recordType): void
    {

        $modelKey = $recordType->model . ':' . $recordType->name . ':RecordType';
        $idKey = $recordType->model . ':' . $recordType->name . ':RecordTypeId';

        Cache::forget($modelKey);
        Cache::forget($idKey);
        Cache::put($modelKey, $recordType, now()->addDays(7));
        Cache::put($idKey, $recordType->id, now()->addDays(7));

    }

    /**
     * Handle the RecordType "deleted" event.
     */
    public function deleted(RecordType $recordType): void
    {
        $modelKey = $recordType->model . ':' . $recordType->name . ':RecordType';
        $idKey = $recordType->model . ':' . $recordType->name . ':RecordTypeId';

        Cache::forget($modelKey);
        Cache::forget($idKey);
    }

    /**
     * Handle the RecordType "restored" event.
     */
    public function restored(RecordType $recordType): void
    {
        //
    }

    /**
     * Handle the RecordType "force deleted" event.
     */
    public function forceDeleted(RecordType $recordType): void
    {
        //
    }
}
