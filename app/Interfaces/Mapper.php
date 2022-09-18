<?php

namespace App\Interfaces;

interface Mapper
{
    public function map(array $attributes): DTO;
}
