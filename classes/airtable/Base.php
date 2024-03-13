<?php namespace Renick\AirTable\Classes\AirTable;

class Base
{
    /** @var Table[] */
    public array $tables;

    /**
     * @param Table[] $tables
     */
    public function __construct(array $tables)
    {
        $this->tables = $tables;
    }

    /**
     * @return Table[]
     */
    public function getTables(): array
    {
        return $this->tables;
    }

    /**
     * @param Table[] $tables
     */
    public function setTables(array $tables): self
    {
        $this->tables = $tables;
        return $this;
    }

    public static function fromJson(array $data): self
    {
        return new self(
            array_map(static function($data) {
                return Table::fromJson($data);
            }, $data['tables'] ?? [])
        );
    }
}
