<x-layout>
    <h1>Lists of Best Sellers:</h1>
    <div class="book-list">
        @foreach($books as $book)
            <div class="book">
                @if (!$book->bookDetails)
                    @continue
                @endif
                <h2>{{$book->bookDetails[0]['title']}}</h2>
                <div>{{$book->bookDetails[0]['description']}}</div>
                <div>
                    <span>{{$book->bookDetails[0]['author']}}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
