@extends("frontend.master")

@section("title", $author->surname." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-body">
                    <div class="post-single-title">
                        <h1>{{ $author->surname }}</h1>
                        <ul class="entry-meta">
                            <li class="entry-cat"> <a href="{{ route("frontend.authors", $author->id) }}" class="category-style-1 "><span class="line"></span>{{ $author->surname }}</a></li>
                            <li class="post-date"> <span class="line"></span>{{ $author->created_at->format("F d, Y") }}</li>
                        </ul>
                    </div>
                    <div class="post-single-description">
                        {!! $author->name !!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection