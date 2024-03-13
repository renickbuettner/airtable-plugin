<?php namespace Renick\AirTable\Console;

use Exception;
use Illuminate\Console\Command;
use Renick\AirTable\Classes\AirTable\AirTable;
use Renick\AirTable\Classes\AirTable\AsyncAirTable;

/**
 * Tables Command
 *
 * @link https://docs.octobercms.com/3.x/extend/console-commands.html
 */
class Tables extends Command
{
    /**
     * @var string signature for the console command.
     */
    protected $signature = 'airtable:tables {--async}';

    /**
     * @var string description is the console command description
     */
    protected $description = 'Get a list of tables in the AirTable database.';

    /**
     * handle executes the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        $this->getOutput()->section(trans('renick.airtable::lang.tables.title'));
        $isAsync = !!$this->option('async');

        $airtable = $isAsync ?
            AsyncAirTable::instance() :
            AirTable::instance();

        $tables = $airtable->getTables();

        $headers = collect(['id', 'name', 'primary_field', 'description'])->map(static function($header) {
            return trans("renick.airtable::lang.tables.columns.{$header}");
        })->toArray();

        $rows = collect($tables)->map(static function($table) {
            $primaryField = $table->getFieldById($table->primaryFieldId);
            return [
                'id' => $table->getId(),
                'name' => $table->getName(),
                'primary_field' => $primaryField?->getName() ?? '',
                'description' => $table->getDescription()
            ];
        });

        $this->table($headers, $rows);
    }
}
