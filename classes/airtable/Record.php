<?php namespace Renick\AirTable\Classes\AirTable;

class Record
{
    public string $id;
    public string $createdTime;
    public array $fields;

    public function __construct(
        string $id,
        string $createdTime,
        array $fields
    ) {
        $this->id = $id;
        $this->createdTime = $createdTime;
        $this->fields = $fields;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedTime(): string
    {
        return $this->createdTime;
    }

    public function getFields(): array
    {
        return $this->fields;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setCreatedTime(string $createdTime): self
    {
        $this->createdTime = $createdTime;
        return $this;
    }

    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    public static function fromJson(array $data): self
    {
        return new self(
            $data['id'],
            $data['createdTime'],
            $data['fields'] ?? []
        );
    }
}
