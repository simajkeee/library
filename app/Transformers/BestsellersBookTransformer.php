<?php

namespace App\Transformers;

class BestsellersBookTransformer extends AbstractTransformer
{
    public function toArray(): array
    {
        return [
            'list_name' => isset($this->dataToTransform['list_name']) && is_scalar($this->dataToTransform['list_name']) ? $this->dataToTransform['list_name'] : '',
            'isbns' => isset($this->dataToTransform['isbns']) && is_array($this->dataToTransform['isbns']) ? $this->dataToTransform['isbns'] : [],
            'book_details' =>         isset($this->dataToTransform['book_details']) && is_array($this->dataToTransform['book_details']) ? $this->dataToTransform['book_details'] : [],
        ];
    }
}
