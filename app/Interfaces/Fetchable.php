<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response;

interface Fetchable
{
    public function fetch(array $params): Response;
}
