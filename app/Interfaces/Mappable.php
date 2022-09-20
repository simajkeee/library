<?php

namespace App\Interfaces;

interface Mappable
{
    public function map(array $attributes): DTO;
}
