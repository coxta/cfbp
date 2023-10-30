<?php

namespace App\Models\Traits;
use Illuminate\Support\Facades\Cache;
use App\Models\RecordType;

trait HasRecordTypes
{

    public static function model() {
        return class_basename(__CLASS__);
    }

    public function type()
    {
        return $this->belongsTo(RecordType::class);
    }

    public static function types()
    {
        $model = self::model();
        return RecordType::select([
            'id',
            'id as value',
            'name',
            'model',
            'description',
            'created_at',
            'updated_at',
            'deleted_at',
            'archived'
        ])
        ->where('model', $model);
    }

    public static function getType($name)
    {
        $model = self::model();
        $key = $model . ':' . $name . ':RecordType';
        return Cache::remember($key, now()->addDays(7), function () use($model, $name) {
            return RecordType::where('model', $model)->where('name', $name)->first();
        });
    }

    public static function getTypeId($name)
    {
        $model = self::model();
        $key = $model . ':' . $name . ':RecordTypeId';
        return Cache::remember($key, now()->addDays(7), function () use($model, $name) {
            return RecordType::where('model', $model)->where('name', $name)->first()->id ?? null;
        });
    }
}