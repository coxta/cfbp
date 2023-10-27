<?php

namespace App\Models\Traits;
use Illuminate\Support\Facades\Cache;
use App\Models\RecordType;

trait HasRecordTypes
{

    public static function model() {
        return class_basename(__CLASS__);
    }

    public static function recordType($name)
    {
        $model = self::model();
        $key = $model . ':' . $name . ':RecordType';
        return Cache::remember($key, now()->addDays(7), function () use($model, $name) {
            return RecordType::where('model', $model)->where('name', $name)->first();
        });
    }

    public static function recordTypeId($name)
    {
        $model = self::model();
        $key = $model . ':' . $name . ':RecordTypeId';
        return Cache::remember($key, now()->addDays(7), function () use($model, $name) {
            return RecordType::where('model', $model)->where('name', $name)->first()->id ?? null;
        });
    }
}