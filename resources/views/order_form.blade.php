<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Form</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body>
    <div class="card mt-5">
        <div class="body">
            <h3 class="p-3 text-center">Order From</h3>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1 text-center">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                        href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                        aria-selected="true">New Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-one-profile" role="tab"
                                        aria-controls="custom-tabs-one-profile" aria-selected="false">Order Lists</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-home-tab">
                                    <form action="{{ route('order.submit') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            @foreach ($dishes as $dish)
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <div class="card" style="width: 18rem;">
                                                        <img src="{{ url('/images/' . $dish->image) }}"
                                                            class="card-img-top p-2" width="180" height="180" alt="...">
                                                        <div class="card-body text-center">
                                                            <h5 class="mb-4"><b>{{ $dish->name }}</b></h5>
                                                            <label for="">Qty : </label>
                                                            <input type="number" name="{{ $dish->id }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6 mx-auto mt-3">
                                                <select name="table" class="form-control">
                                                    <option value="">Select Table</option>
                                                    @foreach ($tables as $table)
                                                        <option value="{{ $table->id }}">
                                                            {{ $table->number }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 col-12 mx-auto text-center mt-5">
                                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-one-profile-tab">
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
                                                            <a href="/order/{{ $order->id }}/serve"
                                                                class="btn btn-warning">Serve</a>
                                                        </div>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="/plugins/jszip/jszip.min.js"></script>
    <script src="/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            title: 'Order Submitted Successful'
            })
        @endif
    </script>
</body>

</html>
