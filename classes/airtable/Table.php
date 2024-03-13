<?php namespace Renick\AirTable\Classes\AirTable;

class Table
{
    public ?string $description;
    /** @var Field[] */
    public array $fields;
    public string $id;
    public string $name;
    public string $primaryFieldId;
    /** @var View[] */
    public array $views;

    /**
     * @param Field[] $fields
     * @param View[] $views
     */
    public function __construct(
        ?string $description,
        array $fields,
        string $id,
        string $name,
        string $primaryFieldId,
        array $views
    ) {
        $this->description = $description;
        $this->fields = $fields;
        $this->id = $id;
        $this->name = $name;
        $this->primaryFieldId = $primaryFieldId;
        $this->views = $views;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return Field[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    public function getFieldById(string $id): ?Field
    {
        return collect($this->fields)->first(static function($field) use ($id) {
            return $field->id === $id;
        });
    }

    public function getFieldByName(string $name): ?Field
    {
        return collect($this->fields)->first(static function($field) use ($name) {
            return $field->name === $name;
        });
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrimaryFieldId(): string
    {
        return $this->primaryFieldId;
    }

    /**
     * @return View[]
     */
    public function getViews(): array
    {
        return $this->views;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param Field[] $fields
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
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

    public function setPrimaryFieldId(string $primaryFieldId): self
    {
        $this->primaryFieldId = $primaryFieldId;
        return $this;
    }

    /**
     * @param View[] $views
     */
    public function setViews(array $views): self
    {
        $this->views = $views;
        return $this;
    }

    public static function fromJson(array $data): self
    {
        return new self(
            $data['description'] ?? null,
            array_map(static function($data) {
                return Field::fromJson($data);
            }, $data['fields']),
            $data['id'],
            $data['name'],
            $data['primaryFieldId'],
            array_map(static function($data) {
                return View::fromJson($data);
            }, $data['views'])
        );
    }
}
