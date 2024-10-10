<div class="col-lg-8 oredoo-content">
    <div class="theiaStickySidebar">
        @forelse ($books as $book)
        <div class="book-list book-list-style1 pt-0">
            <div class="book-list-image">
                <a href="{{ route("frontend.book", $book->id) }}">
                    <img src="{{ asset("uploads/category/".$book->image) }}" alt="{{ $book->title }}">
                </a>
            </div>
            <div class="book-list-title">
                <div class="entry-title">
                    <h5>
                        <a href="{{ route("frontend.book", $book->id) }}">{{ $book->title }}</a>
                    </h5>
                </div>
            </div>
            <div class="book-list-category">
                <div class="entry-cat">
                    <a href="{{ route("frontend.category", $book->category->id) }}" class="category-style-1">{{ $book->category->title }}</a>
                </div>
            </div>
        </div>
        @empty
        <p>No book found!</p>
        @endforelse
        <div class="pagination">
            <div class="pagination-area">
                <div class="row">
                    <div class="col-lg-12">
                        {{ $books->links("vendor.pagination.custom") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
