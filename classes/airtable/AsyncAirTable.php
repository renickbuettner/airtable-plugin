<?php namespace Renick\AirTable\Classes\AirTable;

use Cache;

class AsyncAirTable extends AirTable
{
    protected const DEFAULT_TLL = 60 * 60 * 24; // 24 hours

    public function getBase(): Base
    {
        return $this->withCache(function() {
            return parent::getBase();
        }, 'base');
    }

    /**
     * @return Table[]
     */
    public function getTables(): array
    {
        return $this->withCache(function() {
            return parent::getTables();
        }, 'tables');
    }

    /**
     * @param RecordQueryParams $options
     * @return Records
     */
    public function getRecords(RecordQueryParams $options): Records
    {
        return $this->withCache(function() use ($options) {
            return parent::getRecords($options);
        }, "records_{$options->tableId}_{$options->toQueryParams()['offset']}");
    }

    protected function withCache(callable $callback, string $key = null, $tll = null): mixed
    {
        $seconds = $tll ?? env('AIRTABLE_CACHE_TTL', self::DEFAULT_TLL);
        $key = $key ?? md5(serialize($callback));
        return Cache::remember("renick_airtable_{$key}", $seconds, $callback);
    }
}
