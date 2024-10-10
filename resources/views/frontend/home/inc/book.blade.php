<div class="col-lg-8 content">
    <div class="theiaStickySidebar">
        <div class="section-title">
            <h3>New Books</h3>
        </div>
        @forelse ($books as $book)
        <div class="post-list post-list-style4">
            <div class="post-list-image">
                <a href="{{ route("frontend.book", $book->id) }}">
                    <img src="{{ asset("uploads/category/".$book->image) }}" alt="{{ $book->title }}"/>
                </a>
            </div>
            <div class="post-list-content">
                <ul class="entry-meta">
                    <li class="entry-cat">
                        <a href="{{ route("frontend.category", $book->category->id) }}" class="category-style-1">{{ $book->category->title }}</a>
                    </li>
                    <li class="post-date"> <span class="line"></span>{{ $book->created_at->format("F d, Y") }}</li>
                </ul>
                <h5 class="entry-title">
                    <a href="{{ route("frontend.book", $book->id) }}">{{ $book->title }}</a>
                </h5>

                <div class="post-btn">
                    <a href="{{ route("frontend.book", $book->id) }}" class="btn-read-more">Details<i class="las la-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
        @empty
        <div>No book found!</div>
        @endforelse
        <div class="pagination">
            <div class="pagination-area">
            {{ $books->links("vendor.pagination.custom") }}
            </div>
        </div>
    </div>
</div>
