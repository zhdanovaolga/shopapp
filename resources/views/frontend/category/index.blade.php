@extends("frontend.master")

@section("title", $category->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<div class="section-heading " >
    <div class="container-fluid">
         <div class="section-heading-2">
             <div class="row">
                 <div class="col-lg-12">
                     <div class="section-heading-2-title">
                         <h1>{{ $category->title }}</h1>
                         <p class="links"><a href="{{ route("frontend.home") }}">Home <i class="las la-angle-right"></i></a> {{ $category->title }}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
</div>
<section class="blog-layout-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @forelse ($books as $book)
                <div class="book-list book-list-style2">
                    <div class="book-list-image">
                        <a href="{{ route("frontend.book", $book->id) }}">
                            <img src="{{ asset("uploads/category/".$book->image) }}" alt="{{ $book->title }}"/>
                        </a>
                    </div>
                    <div class="book-list-content">
                        <h3 class="entry-title">
                            <a href="{{ route("frontend.book", $book->id) }}">{{ $book->title }}</a>
                        </h3>
                        <ul class="entry-meta">
                            <li class="entry-cat"><a href="{{ route("frontend.category", $book->category->id) }}" class="category-style-1"><span class="line"></span>{{ $book->category->title }}</a></li>
                            <li class="book-date"><span class="line"></span>{{ $book->created_at->format("F d, Y") }}</li>
                        </ul>
                        <div class="post-exerpt">
                            <p>{{ $str::words(strip_tags($book->description), 20) }}</p>
                        </div>
                        <div class="post-btn">
                            <a href="{{ route("frontend.book", $book->id) }}" class="btn-read-more">Continue Reading <i class="las la-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
                @empty
                <div>No book found!</div>
                @endforelse
            </div>
        </div>
    </div>
</section>
<div class="pagination">
    <div class="container-fluid">
        <div class="pagination-area">
            <div class="row">
                <div class="col-lg-12">
                    {{ $books->links("vendor.pagination.custom") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
