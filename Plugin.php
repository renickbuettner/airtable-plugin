<?php namespace Renick\AirTable;

use Exception;
use Renick\AirTable\Classes\AirTable\AsyncAirTable;
use Renick\AirTable\Console\Backup;
use Renick\AirTable\Console\Tables;
use Renick\AirTable\Console\Records;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{

    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'renick.airtable::lang.plugin.name',
            'description' => 'renick.airtable::lang.plugin.description',
            'author' => 'Renick Büttner',
            'icon' => 'icon-database'
        ];
    }

    public function register()
    {
        // no-op
    }


    public function boot(): void
    {
        $this->registerConsoleCommand('airtable.tables', Tables::class);
        $this->registerConsoleCommand('airtable.records', Records::class);
        $this->registerConsoleCommand('airtable.backup', Backup::class);
    }

    public function registerComponents(): array
    {
        return [
            \Renick\AirTable\Components\Tables::class => 'airTables',
            \Renick\AirTable\Components\Records::class => 'airRecords'
        ];
    }

    private static AsyncAirTable $asyncInstance;

    /**
     * @throws Exception
     */
    public static function asyncInstance(): AsyncAirTable
    {
        return self::$asyncInstance ??= AsyncAirTable::instance(null, null);
    }

}
