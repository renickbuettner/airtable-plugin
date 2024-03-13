<?php namespace Renick\AirTable;

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
    public function pluginDetails()
    {
        return [
            'name' => 'renick.airtable::lang.plugin.name',
            'description' => 'renick.airtable::lang.plugin.description',
            'author' => 'Renick Büttner',
            'icon' => 'icon-bug'
        ];
    }

    public function register()
    {
        // no-op
    }


    public function boot()
    {
        parent::boot();

        $this->registerConsoleCommand('airtable.tables', Tables::class);
        $this->registerConsoleCommand('airtable.records', Records::class);
    }

}
