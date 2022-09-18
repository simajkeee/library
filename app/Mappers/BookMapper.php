<?php

namespace App\Mappers;

use App\DTOs\Book;
use App\Interfaces\DTO;
use App\Interfaces\Mapper;

class BookMapper implements Mapper
{
    public function map(array $attributes): DTO
    {
        $book = new Book();
        $book->title = $attributes['title'] ?? '';
        $book->description = $attributes['description'] ?? '';
        $book->author = $attributes['author'];
        return $book;
    }
}
