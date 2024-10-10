@extends('dashboard.master')
@section('title', 'Book')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Book</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Book</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Book</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                @foreach ($errors->all() as $error)
                                <p class="m-0">{{ $error }}</p>
                                @endforeach
                            </div>
                            @endif
                            @if (session("success"))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h5><i class="icon fas fa-check"></i> Success!</h5>
                                <p class="m-0">{{ session("success") }}</p>
                            </div>
                            @endif
                            <div class="table-responsive">
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
                    <div class="post-single-user">
                        {!! $book->current_user->name !!}
                    </div>
                    <form action="{{ route("dashboard.books.return", $book->id) }}" method="POST">
                            @method("POST")
                            @csrf
                            <button 
                            type="submit"
                            onclick= "return confirm('Are You Sure Want to Return Book?')" >Return Book</button>
                    </form>
                </div>
            </div>
        </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section("script")
<script src="{{ asset("assets/dashboard/plugins/sweetalert2/sweetalert2.all.js") }}"></script>
<script>
$('.deletebtn').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    Swal.fire({
        title: 'Are you sure?',
        type: 'warning',
        icon: 'warning',
        text: 'All comments of this post will delete!',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            form.submit();
        }
    });
});
</script>
@endsection
