<?php namespace Renick\AirTable\Console;

use Exception;
use Illuminate\Console\Command;
use Renick\AirTable\Classes\AirTable\AirTable;
use Renick\AirTable\Classes\AirTable\AsyncAirTable;
use Renick\AirTable\Classes\AirTable\RecordQueryParams;

/**
 * Tables Command
 *
 * @link https://docs.octobercms.com/3.x/extend/console-commands.html
 */
class Records extends Command
{
    /**
     * @var string signature for the console command.
     */
    protected $signature = 'airtable:records {tableId} {--async}';

    /**
     * @var string description is the console command description
     */
    protected $description = 'Get records of a tables in the AirTable database.';

    /**
     * handle executes the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        $this->getOutput()->section(trans('renick.airtable::lang.records.title'));
        $isAsync = !!$this->option('async');

        $airtable = $isAsync ?
            AsyncAirTable::instance() :
            AirTable::instance();


        $tableId = $this->argument('tableId');
        $records = $airtable->getRecords(
            new RecordQueryParams($tableId)
        );

        $this->table($records->getFieldNames(), $records->toArray());
    }
}
