@extends("frontend.master")



@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-body">
                    <div class="form-group">
                       <form action="{{ route("frontend.books.setbuy", $book->id) }}" method="POST">
                       @csrf
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <label for="buy">Buy</label>
                                    <div class="post-single-price">
                                    Price:  {!! $book->price !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 text-center">
                                <button class="btn btn-primary" type="submit">Buy</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
