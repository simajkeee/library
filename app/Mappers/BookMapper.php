<?php

namespace App\Mappers;

use App\DTOs\Book;
use App\Interfaces\DTO;
use App\Interfaces\ListMappable;
use App\Interfaces\Mappable;

class BookMapper implements Mappable, ListMappable
{
    public function map(array $attributes): DTO
    {
        $book = new Book();
        $book->title = $attributes['title'] ?? '';
        $book->description = $attributes['description'] ?? '';
        $book->author = $attributes['author'];
        return $book;
    }

    public function mapList(array $list): array
    {
        $result = [];
        foreach ($list as $item) {
            $result[] = $this->map($item);
        }
        return $result;
    }
}
