@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        @if (Session::has('customer_delete_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('customer_delete_message') }}</p>
                    {{ Session::forget('customer_delete_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Customers</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Office Address</th>
                                    <th>Delivery Address</th>
                                    <th>NID</th>
                                    <th>Passport</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $cnt++ }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->mobile }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->delivery_address }}</td>
                                        <td>{{ $customer->nid }}</td>
                                        <td>{{ $customer->passport }}</td>
                                        <td>{{ $customer->comment }}</td>
                                        <td>
                                            <span class="">
                                                <a href="{{ route('customers.edit', $customer->id) }}">
                                                    <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                                </a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="{{ route('customers.delete', $customer->id) }}">
                                                    <small class="label bg-red" style="margin-right: 15px">Delete</small>
                                                </a>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr.</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>NID</th>
                                    <th>Passport</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>

    </section>
@endsection

@push('js')
    <script>
        $(function() {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false
            })
        });

    </script>
@endpush
