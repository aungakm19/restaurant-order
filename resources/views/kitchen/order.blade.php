@extends('layouts.master')
@section('order_active', 'nav-link active')
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
                                <h3 class="card-title">Order Lists</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="dishes" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>Dish Name</th>
                                            <th>Table Number</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>    
                                                <td>{{ $order->dish->name }}</td>  
                                                <td>{{ $order->table_id }}</td>
                                                <td>{{ $status[$order->status] }}</td>
                                                <td>
                                                    <div>
                                                        <a href="/order/{{ $order->id }}/approve"
                                                            class="btn btn-warning">Approve</a>
                                                        <a href="/order/{{ $order->id }}/cancel"
                                                            class="btn btn-danger">Cancel</a>
                                                        <a href="/order/{{ $order->id }}/ready"
                                                            class="btn btn-success">Ready</a>
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
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })
            @if (session('message'))
                Toast.fire({
                icon: 'success',
                title: 'Order Approved'
            })
            @endif
    </script>
@endsection

<script src="plugins/jquery/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

