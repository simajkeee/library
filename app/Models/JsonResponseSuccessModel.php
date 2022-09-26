<?php

namespace App\Models;

class JsonResponseSuccessModel extends AbstractJsonResponse
{
    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'data' => $this->data,
        ];
    }
}
