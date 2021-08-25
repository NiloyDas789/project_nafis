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
        @if (Session::has('product_delete_message'))
            <div class="row">
                <div class="col-md-6">
                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                        {{ Session::get('product_delete_message') }}</p>
                    {{ Session::forget('product_delete_message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Accounts</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <p class="text-primary">Total Transaction amount: <b>{{ $totalTransaction }}</b></p>

                        <form class="form-horizontal" action="{{ route('account.filter') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info pull-right pull-bottom">
                                        Fiter</button>

                                    <div class="col-sm-2 pull-right">
                                        <input type="date" class="form-control " name="toDate">
                                    </div>
                                    <div class="col-sm-2 pull-right">
                                        <input type="date" class="form-control" name="fromDate">
                                    </div>
                                </div>
                            </div>
                        </form>


                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th>Reference</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ date_format(date_create($account->created_at), 'm/d/Y h:i A') }}</td>
                                        <td>{{ $account->amount }}</td>
                                        <td>{{ $account->account_type }}</td>
                                        <td>{{ $account->customer_name }}</td>
                                        <td>{{ $account->category }}</td>
                                        <td>{{ $account->reference }}</td>
                                        <td>{{ $account->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Date.</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th>Reference</th>
                                    <th>Description</th>
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
