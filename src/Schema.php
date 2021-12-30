<?php

namespace Light2000\LaravelMigrationColumnsSort;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Schema as BaseSchema;

/**
 * Class Schema
 * @package Light2000\LaravelMigrationColumnsSort
 */
class Schema extends BaseSchema
{
    /**
     * Use Column Sort Blueprint
     * @param Builder $builder
     * @return Builder
     */
    protected static function withBlueprintResolver(Builder $builder)
    {
        $builder->blueprintResolver(function ($table, $callback, $prefix) {
            return new Blueprint($table, $callback, $prefix);
        });

        return $builder;
    }

    /**
     * Get a schema builder instance for a connection.
     *
     * @param string|null $name
     * @return Builder
     */
    public static function connection($name)
    {
        return self::withBlueprintResolver(parent::connection($name));
    }

    /**
     * Get a schema builder instance for the default connection.
     *
     * @return Builder
     */
    protected static function getFacadeAccessor()
    {
        return self::withBlueprintResolver(parent::getFacadeAccessor());
    }
}