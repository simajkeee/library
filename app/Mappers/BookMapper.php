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
        $book->listName = isset($attributes['list_name']) && is_scalar($attributes['list_name']) ? $attributes['list_name'] : '';
        $book->isbns = isset($attributes['isbns']) && is_array($attributes['isbns']) ? $attributes['isbns'] : [];
        $book->bookDetails = isset($attributes['book_details']) && is_array($attributes['book_details']) ? $attributes['book_details'] : [];
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
