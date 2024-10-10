@extends('dashboard.master')
@section('title', 'All Books')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Books</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Books</li>
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
                            <h3 class="card-title">All Books</h3>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>@sortablelink('title', 'Title')</th>
                                            <th>@sortablelink('description', 'Desciption')</th>
                                            <th>@sortablelink('price', 'Price')</th>
                                            <th>@sortablelink('publish_year', 'Publish Year')</th>
                                            <th>@sortablelink('category', 'Category')</th>
                                            <th>@sortablelink('rented', 'Rented')</th>
                                            <th>@sortablelink('purchased', 'Purchased')</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($books as $book)
                                        <tr>
                                            <td class="text-center">{{ $loop->index + $books->firstItem() }}</td>
                                            <td>{{ $book->title }}</td>
                                            <td class="text-center">{{ $book->description }}</td>
                                            <td class="text-center">{{ $book->price }}</td>
                                            <td class="text-center">{{ $book->publish_year }}</td>
                                            <td class="text-center">{{ $book->category->title }}</td>
                                            <td class="text-center">{{ $book->rented }}</td>
                                            <td class="text-center">{{ $book->purchased }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a target="_blank" href="{{ $book->id ? route("frontend.book", $book->id) : "" }}" class="btn btn-success {{ $book->id ? "" : " disabled" }}">View</a>
                                                    <a href="{{ route("dashboard.books.edit", $book->id) }}" class="btn btn-warning">Edit</a>
                                                    <form action="{{ route("dashboard.books.destroy", $book->id) }}" method="POST">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger deletebtn">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="11" class="text-center">No book found!</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                            {{ $books->links() }}
                            </ul>
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
