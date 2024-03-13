<?php namespace Renick\AirTable\Classes\AirTable;

use Exception;

class AirTable extends Client
{
    protected const PAGE_SIZE = 100; // AirTable max page size

    public function getBase(): Base
    {
        $res = $this->get("meta/bases/{$this->selectedDatabaseId}/tables")->json();
        return Base::fromJson($res);
    }

    /**
     * @return Table[]
     */
    public function getTables(): array
    {
        return $this->getBase()->getTables();
    }

    /**
     * @param RecordQueryParams $options
     * @return Records
     * @throws Exception
     */
    public function getRecords(RecordQueryParams $options): Records
    {
        $queryParams = $options->toQueryParams();
        $res = $this->get("{$this->selectedDatabaseId}/{$options->tableId}", $queryParams)->json();

        if (isset($res['error'])) {
            $this->onError("{$res['error']['type']} {$res['error']['message']}");
        }

        if (isset($res['offset'])) {
            $next = $this->get("{$this->selectedDatabaseId}/{$options->tableId}", array_merge($options->toQueryParams(), ['offset' => $res['offset']]))->json();
            $res['records'] = array_merge($res['records'], $next['records']);
            $res['offset'] = $next['offset'];
        }

        return Records::fromJson($res);
    }

    /**
     * @throws Exception
     */
    protected function onError(string $message): void
    {
        throw new Exception("AirTable error: {$message}");
    }

    /**
     * @throws Exception
     */
    public static function instance(string $databaseId = null, string $personalAccessToken = null): self
    {
        $token = env('AIRTABLE_PERSONAL_TOKEN', $personalAccessToken);
        $baseId = env('AIRTABLE_DATABASE_ID', $databaseId);

        if (empty($token) ||
            empty($baseId)) {
            throw new Exception(trans('renick.airtable::lang.errors.credentials'));
        }

        return new self(
            env('AIRTABLE_PERSONAL_TOKEN', $personalAccessToken),
            env('AIRTABLE_DATABASE_ID', $databaseId)
        );
    }
}
