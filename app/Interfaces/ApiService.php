<?php

namespace App\Interfaces;

use Illuminate\Http\Client\Response;

interface ApiService
{
    public function fetch(array $params): Response;
}
