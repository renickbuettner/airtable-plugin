<?php namespace Renick\AirTable\Classes\AirTable;

class Field
{
    public ?string $description;
    public string $id;
    public string $name;
    public string $type;
    public array $options;

    public function __construct(
        ?string $description,
        string $id,
        string $name,
        string $type,
        array $options
    ) {
        $this->description = $description;
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
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

    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public static function fromJson(array $data): self
    {
        return new self(
            $data['description'] ?? null,
            $data['id'],
            $data['name'],
            $data['type'],
                $data['options'] ?? []
        );
    }
}
