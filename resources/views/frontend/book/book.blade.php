@extends("frontend.master")

@section("content")
<div style="height: 100px"></div>
<section class="blog-author mt-30">
    <div class="container-fluid">
        <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>@sortablelink('title', 'Title')</th>
                        <th>@sortablelink('description', 'Desciption')</th>
                        <th>@sortablelink('price', 'Price')</th>
                        <th>@sortablelink('publish_year', 'Publish Year')</th>
                        <th>@sortablelink('category', 'Category')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $book)
                    <tr>
                        <td class="text-center"><a href="{{ route("frontend.book", $book->id) }}">
                        {{ $book->title }} </a></td>   
                        <td class="text-center">{{ $book->description }}</td>
                        <td class="text-center">{{ $book->price }}</td>
                        <td class="text-center">{{ $book->publish_year }}</td>
                        <td class="text-center">{{ $book->category->title }}</td>
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
    <div class="pagination">
        <div class="pagination-area">
            <div class="row">
                <div class="col-lg-12">
                    {{ $books->links("vendor.pagination.custom") }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
