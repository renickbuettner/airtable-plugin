<?php namespace Renick\AirTable\Classes\AirTable;

use Cache;

class AsyncAirTable extends AirTable
{
    protected const DEFAULT_TLL = 60 * 60 * 24; // 24 hours

    public function getBase(int $tll = null): Base
    {
        return $this->withCache(function() {
            return parent::getBase();
        }, 'base', $tll ?? self::DEFAULT_TLL);
    }

    /**
     * @return Table[]
     */
    public function getTables(int $tll = null): array
    {
        return $this->withCache(function() {
            return parent::getTables();
        }, 'tables', $tll ?? self::DEFAULT_TLL);
    }

    /**
     * @param RecordQueryParams $options
     * @return Records
     */
    public function getRecords(RecordQueryParams $options, int $tll = null): Records
    {
        $hash = md5(serialize($options->toQueryParams()));

        return $this->withCache(function() use ($options) {
            return parent::getRecords($options);
        }, "records_{$options->tableId}_{$hash}", $tll ?? self::DEFAULT_TLL);
    }

    protected function withCache(callable $callback, string $key = null, $tll = null): mixed
    {
        $seconds = $tll ?? env('AIRTABLE_CACHE_TTL', self::DEFAULT_TLL);
        $key = $key ?? md5(serialize($callback));
        return Cache::remember("renick_airtable_{$key}", $seconds, $callback);
    }

    public static function instance(string $databaseId = null, string $personalAccessToken = null): self
    {
        $token = env('AIRTABLE_PERSONAL_TOKEN', $personalAccessToken);
        $baseId = env('AIRTABLE_DATABASE_ID', $databaseId);
        return new self($token, $baseId);
    }
}
