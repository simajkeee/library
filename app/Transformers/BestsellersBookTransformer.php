<?php

namespace App\Transformers;

class BestsellersBookTransformer extends AbstractTransformer
{
    public function toArray(): array
    {
        return $this->dataToTransform['book_details'][0] ?? [];
    }
}
