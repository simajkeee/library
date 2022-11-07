<?php

namespace App\Transformers;

class BestsellersBookListTransformer extends AbstractTransformer
{
    public function toArray(): array
    {
        return array_filter(array_map(fn($book) => BestsellersBookTransformer::transform($book), $this->dataToTransform));
    }
}
