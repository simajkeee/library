<?php

namespace App\Transformers;

abstract class AbstractTransformer
{
    public function __construct(protected array $dataToTransform)
    {
    }

    static public function transform(array $toCustomArray): array
    {
        return (new static($toCustomArray))->toArray();
    }

    abstract public function toArray(): array;

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
