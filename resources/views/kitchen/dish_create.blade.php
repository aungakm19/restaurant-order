@extends('layouts.master')
@section('dish_active', 'nav-link active')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kitchen Panel</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create a delicious dish</h3>
                                <a href="/dish" class="btn btn-primary float-right">Back</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="/dish" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Dish Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                                        <div class="col-sm-10">
                                            <select name="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="image" class="col-sm-2 col-form-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" name="dish_image">
                                        </div>
                                    </div>
                                    <div class="text-center pt-5">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
