@extends("frontend.master")



@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-body">
                    <div class="form-group">
                       <form action="{{ route("frontend.books.setrent", $book->id) }}" method="POST">
                       @csrf
                            <div class="row">
                                <div class="col-md-12 mx-auto">
                                    <label for="rent">Rent</label>
                                    <select class="form-control" name="rented" id="rented">
                                        @if (auth()->user()->role != 1)
                                        <option value="weeks">2 Weeks</option>
                                        @endif
                                        <option value="month">1 Month</option>
                                        <option value="months">3 Months</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2 text-center">
                                <div class="col text-center">
                                    <button class="btn btn-primary" type="submit">Rent</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
