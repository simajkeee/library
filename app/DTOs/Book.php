<?php

namespace App\DTOs;

use App\Interfaces\DTO;

class Book implements DTO
{
    public ?string $title = '';
    public ?string $description = '';
    public ?string $author = '';
}
