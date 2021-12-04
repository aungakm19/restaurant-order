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
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">Dishes</h3>
                                <a href="/dish/create" class="btn btn-success float-right">Create</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dishes" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Dish Name</th>
                                            <th>Category Name</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dishes as $dish)
                                            <tr>
                                                <td>{{ $dish->name }}</td>
                                                <td>{{ $dish->category->name }}</td>
                                                <td>{{ $dish->created_at }}</td>
                                                <td>
                                                    <div class="form-row text-center">
                                                        <a style="height: 40px; margin-right: 10px;" href="/dish/{{ $dish->id }}/edit"
                                                            class="btn btn-warning">Edit</a>
                                                        <form action="/dish/{{ $dish->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item')" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

<script src="plugins/jquery/jquery.min.js"></script>
<script>
    $(function() {
        $('#dishes').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 8,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script>
