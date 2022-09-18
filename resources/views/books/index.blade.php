<x-layout>
    <h1>Lists of Best Sellers:</h1>
    <div class="book-list">
        @foreach($books as $book)
            <div class="book">
                <h2>{{$book->title}}</h2>
                <div>{{$book->description}}</div>
                <div>
                    <span>{{$book->author}}</span>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
