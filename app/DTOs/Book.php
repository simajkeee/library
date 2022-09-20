<?php

namespace App\DTOs;

use App\Interfaces\DTO;

class Book implements DTO
{
    public ?string $listName    = '';
    public ?array  $isbns       = [];
    public ?array  $bookDetails = [];
}
