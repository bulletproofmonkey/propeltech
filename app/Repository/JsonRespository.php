<?php

namespace App\Repository;

use App\Repository\Exceptions\MismatchedEntityException;
use App\Repository\Exceptions\NotFoundException;
use JsonSerializable;

abstract class JsonRespository
{
    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @var string|null
     */
    private ?string $basePath;

    /**
     * @return string
     */
    abstract protected function getClass(): string;

    /**
     * @param string|null $basePath
     */
    public function __construct(?string $basePath = null)
    {
        $this->basePath = $basePath ?? resource_path('data');

        if (file_exists($this->getPath())) {
            $data = json_decode(file_get_contents($this->getPath()), true, JSON_THROW_ON_ERROR);
            foreach ($data as $id => $datum) {
                $this->data[] = (new ($this->getClass()))->fromArray($datum)->setId($id);
            }
        }
    }

    /**
     * @param int $id
     * @return JsonSerializable
     * @throws NotFoundException
     */
    public function get(int $id): JsonSerializable
    {
        if (isset($this->data[$id])) {
            return $this->data[$id];
        }

        throw new NotFoundException($this->getClass(), $id);
    }

    /**
     * @param string|null $search
     * @return array
     */
    public function getAll(?string $search = null): array
    {
        if ($search) {
            return array_values(
                array_filter($this->data, fn($entity) => $entity->contains($search))
            );
        }
        return $this->data;
    }

    /**
     * @param JsonSerializable $model
     * @param int|null $id
     * @return int
     * @throws MismatchedEntityException
     */
    public function store(JsonSerializable $model, ?int $id = null): int
    {
        if ($model instanceof ($this->getClass())) {
            if ($id !== null) {
                $this->data[$id] = $model;
            } else {
                $id           = count($this->data);
                $this->data[] = $model;
            }
            $this->update();

            return $id;
        }

        throw new MismatchedEntityException($this->getClass(), get_class($model));
    }

    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        if (!isset($this->data[$id])) {
            return;
        }
        unset($this->data[$id]);
        $this->update();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        $class = strtolower($this->getClass());

        $class = substr($class, strrpos($class, '\\') + 1);

        return $this->basePath . DIRECTORY_SEPARATOR . $class . '.json';
    }

    /**
     * @return void
     */
    public function update(): void
    {
        file_put_contents($this->getPath(), json_encode(array_values($this->data), JSON_PRETTY_PRINT));
    }
}
