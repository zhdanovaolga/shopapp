@extends("frontend.master")

@section("title", $book->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-image">
                    <img src="{{ asset("uploads/category/".$book->image) }}" alt="{{ $book->title }}"/>
                </div>
                <div class="post-single-body">
                    <div class="post-single-title">
                        <h1>{{ $book->title }}</h1>
                        <ul class="entry-meta">
                            <li class="entry-cat"> <a href="{{ route("frontend.category", $book->category->id) }}" class="category-style-1 "><span class="line"></span>{{ $book->category->title }}</a></li>
                            <li class="post-date"> <span class="line"></span>{{ $book->created_at->format("F d, Y") }}</li>
                        </ul>
                    </div>
                    <div class="post-single-description">
                        {!! $book->description !!}
                    </div>
                    <div class="post-single-price">
                        {!! $book->price !!}
                    </div>
                    <a href="{{ route("frontend.books.rent", $book->id) }}" class="btn btn-warning">Rent</a>
                    <a href="{{ route("frontend.books.buy", $book->id) }}" class="btn btn-warning">Buy</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
