<?php namespace Renick\AirTable\Classes\AirTable;

class RecordQueryParams
{
    public string $tableId;
    public int $limit = -1; // -1 for all records
    public int $pageSize = 100; // AirTable max page size
    public ?string $offset;
    public ?string $view; // Name or Id of the view to use
    public ?array $sort; // Array of fields to sort by (fieldName => 'asc' or 'desc')
    public ?string $cellFormat; // 'json' or 'string'
    public ?string $timeZone; // 'utc' or see https://airtable.com/developers/web/api/model/timezone
    public ?string $userLocale;

    public function __construct(
        string $tableId,
        int $limit = -1,
        ?string $offset = null,
        ?string $view = null,
        ?array $sort = null,
        ?string $cellFormat = "string",
        ?string $timeZone = 'utc',
        ?string $userLocale = null
    ) {
        $this->tableId = $tableId;
        $this->limit = min($limit, $this->pageSize);
        $this->offset = $offset;
        $this->view = $view;
        $this->sort = $sort;
        $this->cellFormat = $cellFormat;
        $this->timeZone = $timeZone;
        $this->userLocale = $userLocale ?? trans('renick.airtable::lang.records.userLocale');
    }

    public function toQueryParams(): array
    {
        return [
            "offset" => $this->offset,
            "pageSize" => $this->pageSize,
            "maxRecords" => $this->limit > 0 ? $this->limit : null,
            "sort" => $this->sort,
            "view" => $this->view,
            "cellFormat" => $this->cellFormat,
            "timeZone" => $this->timeZone,
            "userLocale" => $this->userLocale
        ];
    }
}
