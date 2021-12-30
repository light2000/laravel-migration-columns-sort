<?php

namespace Light2000\LaravelMigrationColumnsSort;

use Illuminate\Database\Schema\Blueprint as BaseBlueprint;
use Illuminate\Database\Schema\Grammars\Grammar;

class Blueprint extends BaseBlueprint
{
    /**
     * Add the fluent commands specified on any sorted columns.
     * @param Grammar $grammar
     */
    public function addFluentCommands(Grammar $grammar)
    {
        $primaries = current(array_filter($this->commands, function ($command) {
                return 'primary' == $command->get("name");
            }))["columns"] ?? [];

        usort($this->columns, function ($colA, $colB) use ($primaries) {
            $a = $colA['name'];
            $b = $colB['name'];

            (!empty($colA['autoIncrement']) || in_array($a, $primaries)) && $a = chr(0) . $a;
            (!empty($colB['autoIncrement']) || in_array($b, $primaries)) && $b = chr(0) . $b;

            in_array($a, ['created_at', 'updated_at', 'deleted_at']) && $a = chr(126) . $a;
            in_array($b, ['created_at', 'updated_at', 'deleted_at']) && $b = chr(126) . $b;

            return strcmp($a, $b);
        });

        parent::addFluentCommands($grammar);
    }
}
