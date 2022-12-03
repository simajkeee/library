<?php

namespace App\Transformers;

class BestsellersBookFromListTransformer extends AbstractTransformer
{
    public function toArray(): array
    {
        $bookDetails = $this->dataToTransform["book_details"][0] ?? [];
        if (empty($bookDetails)) {
            return [];
        }

        $res = [];

        $res["title"] = $bookDetails["title"] ?? "";
        $res["subtitle"] = $bookDetails["subtitle"] ?? "";
        $res["description"] = $bookDetails["description"] ?? "";
        $res["contributor"] = $bookDetails["contributor"] ?? "";
        $res["author"] = $bookDetails["author"] ?? "";
        $res["publisher"] = $bookDetails["publisher"] ?? "";
        $isbn10 = $bookDetails["primary_isbn10"] ?? "";
        $isbn13 = $bookDetails["primary_isbn13"] ?? "";
        $res["primary_isbn"] = $isbn10 ?: $isbn13;

        return array_filter($res);
    }
}
