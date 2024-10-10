@extends('dashboard.master')
@section('title', 'New Author - ' . config('app.name'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New Author</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.home") }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route("dashboard.authors.index") }}">All Authors</a></li>
                        <li class="breadcrumb-item active">New Author</li>
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
                            <h3 class="card-title">New Author</h3>
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
                            <form action="{{ route("dashboard.authors.store") }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8 mx-auto">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="surname">Surname</label>
                                            <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname" value="{{ old('surname') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="patronymic">Patronymic</label>
                                            <input type="text" class="form-control" id="paronymic" name="patronymic" placeholder="Enter patronymic" value="{{ old('patronymic') }}"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-auto">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Create</button>
                            </form>
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
<script src="{{ asset("assets/dashboard/plugins/speakingurl/speakingurl.min.js") }}"></script>
<script src="{{ asset("assets/dashboard/plugins/slugify/slugify.min.js") }}"></script>
<script>
    $(document).ready(function() {
        $('#title').on("input", () => {
            $('#slug').val($.slugify($('#title').val()));
        });
        function readURL(input) {
            if (input.files && input.files[0] && input.files[0].type.includes("image")) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagepreview').removeClass("d-none");
                    $('#imagepreview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $("#image").val('');
                $('#imagepreview').addClass("d-none");
                Swal.fire({
                    icon: "error",
                    text: "Select a valid image!"
                });
            }
        }
        $("#image").change(function(){
            readURL(this);
        });
    });
</script>
@endsection
