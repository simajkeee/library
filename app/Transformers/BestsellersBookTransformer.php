<?php

namespace App\Transformers;

class BestsellersBookTransformer extends AbstractTransformer
{
    public function toArray(): array
    {
        $bookDetails = $this->dataToTransform[0] ?? [];
        if (empty($bookDetails)) {
            return [];
        }

        $res = [];

        $res["id"] = $bookDetails["id"] ?? [];
        $res["title"] = $bookDetails["volumeInfo"]["title"] ?? [];
        $res["subtitle"] = $bookDetails["volumeInfo"]["subtitle"] ?? [];
        $res["description"] = $bookDetails["volumeInfo"]["description"] ?? [];
        $res["authors"] = $bookDetails["volumeInfo"]["authors"] ?? [];
        $res["publisher"] = $bookDetails["volumeInfo"]["publisher"] ?? [];
        $res["publishedDate"] = $bookDetails["volumeInfo"]["publishedDate"] ?? [];
        $res["categories"] = $bookDetails["volumeInfo"]["categories"] ?? [];
        $res["imageLinks"] = $bookDetails["volumeInfo"]["imageLinks"] ?? [];

        return array_filter($res);
    }
}
