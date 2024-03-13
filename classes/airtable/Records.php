<?php namespace Renick\AirTable\Classes\AirTable;

class Records
{
    /** @var Record[] */
    public array $records;

    /**
     * @param Record[] $records
     */
    public function __construct(array $records)
    {
        $this->records = $records;
    }

    /**
     * @return Record[]
     */
    public function getRecords(): array
    {
        return $this->records;
    }

    /**
     * @param Record[] $records
     */
    public function setRecords(array $records): self
    {
        $this->records = $records;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getFieldNames(): array
    {
        $first = $this->records[0] ?? null;
        return $first ? array_keys($first->getFields()) : [];
    }

    /**
     * @return array[]
     */
    public function toArray(): array
    {
        return array_map(static function(Record $record) {
            return $record->getFields();
        }, $this->records);

    }

    public static function fromJson(array $data): self
    {
        return new self(
            array_map(static function($data) {
                return Record::fromJson($data);
            }, $data['records'])
        );
    }
}
