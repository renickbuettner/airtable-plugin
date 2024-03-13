<?php namespace Renick\AirTable\Classes\AirTable;

class View
{
    public string $id;
    public string $name;
    public string $type;

    public function __construct(
        string $id,
        string $name,
        string $type
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public static function fromJson(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['type']
        );
    }
}
