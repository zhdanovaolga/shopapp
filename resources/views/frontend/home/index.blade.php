@extends("frontend.master")

@section("title", config('app.sitesettings')::first()->site_title." - ".config('app.sitesettings')::first()->tagline)

@section("content")
<div style="height: 100px"></div>

<section class="section-feature-1">
@if (session('expiredBooks'))
    <div class="alert alert-warning">
        
@php 
$books1 = session('expiredBooks'); 

@endphp
<div>Вы должны вернуть книги:</div>
@foreach($books1 as $book1)
<div><a href="{{ route("frontend.book", $book1->id) }}">
                        {{ $book1->title }} </a></div>
@endforeach
    </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            @include("frontend.home.inc.book")
            @include("frontend.home.inc.sidebar")
        </div>
    </div>
</section>
@endsection
