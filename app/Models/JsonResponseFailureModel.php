<?php

namespace App\Models;

class JsonResponseFailureModel extends AbstractJsonResponse
{

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'error' => $this->data,
        ];
    }
}
