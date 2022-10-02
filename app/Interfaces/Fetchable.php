<?php

namespace App\Interfaces;

interface Fetchable
{
    public function fetch(array $params = []): array;
}
