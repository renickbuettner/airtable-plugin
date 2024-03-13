<?php namespace Renick\AirTable\Console;

use Exception;
use Illuminate\Console\Command;
use Renick\AirTable\Classes\AirTable\AirTable;
use Renick\AirTable\Classes\AirTable\RecordQueryParams;
use Str;

/**
 * Backup Command
 *
 * @link https://docs.octobercms.com/3.x/extend/console-commands.html
 */
class Backup extends Command
{
    /**
     * @var string signature for the console command.
     */
    protected $signature = 'airtable:backup {--databaseId}';

    /**
     * @var string description is the console command description
     */
    protected $description = 'Create a backup of your AirTable database';

    /**
     * handle executes the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        $databaseId = $this->option('databaseId');
        if ($databaseId) {
            $this->info("Backing up AirTable database with ID: {$databaseId}");
        }

        $airtable =  AirTable::instance($databaseId);

        foreach ($airtable->getTables() as $table) {
            $this->getOutput()->section("Backing up table: {$table->getName()}");
            $records = $airtable->getRecords(new RecordQueryParams($table->getId(), -1, null, null, null, "json"));
            $this->info("Found {$records->getCount()} records in table: {$table->getName()}");

            $fileName = $this->getFileName($table->getName());
            $this->info("Backing up records to file: {$fileName}");
            $this->saveToFile($fileName, $records->toArray());
        }

        $this->getOutput()->success("Backup complete!");
    }

    protected function getFileName(string $tableName): string
    {
        $slug = Str::slug($tableName);
        return "{$slug}.json";
    }

    protected function saveToFile(string $fileName, array $data): void
    {
        if (!is_dir(storage_path('airtable'))) {
            mkdir(storage_path('airtable'));
            file_put_contents(storage_path('airtable/.gitignore'), "*\n!.gitignore\n");
        }

        $absolutePath = storage_path("airtable/$fileName");
        file_put_contents($absolutePath, json_encode($data, JSON_PRETTY_PRINT));
    }
}
