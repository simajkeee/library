<?php

namespace Mappers;

use App\DTOs\Book;
use App\Mappers\BookMapper;
use PHPUnit\Framework\TestCase;

class BookMapperTest extends TestCase
{
    /**
     * @dataProvider providedData
     */
    public function test_book_mapper(BookMapper $mapper, array $toMap, string $expected)
    {
        $this->assertInstanceOf($expected, $mapper->map($toMap));
    }

    public function providedData()
    {
        return [
            [new BookMapper(), ['list_name' => null, 'isbns' => new \stdClass(), 'book_details' => false], Book::class],
            [new BookMapper(), ['list_name' => 10, 'isbns' => 1], Book::class],
            [new BookMapper(), ['list_name' => '0', 'book_details' => [[], [],]], Book::class],
            [new BookMapper(), ['list_name' => false, 'book_details' => new \stdClass()], Book::class],
            [new BookMapper(), ['list_name' => new \stdClass(), 'book_details' => ''], Book::class],
            [new BookMapper(), ['isbns' => [], 'book_details' => false], Book::class],
            [new BookMapper(), ['list_name' => true], Book::class],
            [new BookMapper(), ['isbns' => ''], Book::class],
            [new BookMapper(), ['author' => null], Book::class],
        ];
    }
}
