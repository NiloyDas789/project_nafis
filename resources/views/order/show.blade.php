@extends('layouts.app2')

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    </section>
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    {{-- <i class="fa fa-globe"></i> {{ $settings->company_name }} --}}
                    <img src="http://127.0.0.1:8000/uploads/logo/1623348692.png" height="100" width="250" alt="Logo">
                    <small class="pull-right">Date: {{ date('d/m/Y') }}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>{{ $settings->company_name }}</strong><br>
                    {{ $settings->company_address }}<br>
                    {{ $settings->company_city }}<br>
                    Phone: {{ $settings->phone }}<br>
                    Email: {{ $settings->email }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong>{{ $order->cname }}</strong><br>
                    {{ $order->address }}<br>
                    Phone: {{ $order->mobile }}<br>
                    Email:
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice {{ $invoice->invoice_id }}</b><br>
                <br>
                <b>Order ID:</b> {{ $order->id }}<br>
                <b>Payment Due:</b> {{ date_format(date_create($order->return_date), 'd/m/Y') }}<br>
                {{-- <b>Account:</b> 968-34567 --}}
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php
        $createdAt = strtotime($order->created_at);
        $returnDate = strtotime($order->return_date);
        $datediff = $returnDate - $createdAt;

        $d = max(round($datediff / (60 * 60 * 24)), 1);
        ?>
        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Article No.</th>
                            <th>Description</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->art_no }}</td>
                                <td>{{ $product->description }}</td>
                                <td>৳ {{ $product->price * $d }} (= {{ $d }} x {{ $product->price }})</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due {{ date_format(date_create($order->return_date), 'd/m/Y') }}</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Created At:</th>
                            <td>{{ date_format(date_create($order->created_at), 'd/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Date From:</th>
                            <td>{{ date_format(date_create($order->start_date), 'd/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Date To:</th>
                            <td>{{ date_format(date_create($order->return_date), 'd/m/Y') }}</td>
                        </tr>

                        <tr>
                            <th style="width:50%">Total Days:</th>
                            <td>{{ $d }}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Total:</th>
                            <td>৳ {{ $order->order_value }}</td>
                        </tr>
                        <tr>
                            <th style="width:50%">Discount:</th>
                            <td>৳ {{ $order->discount_amount }}</td>
                        </tr>
                        <tr>
                            <th>Net Total:</th>
                            <td>৳ {{ $order->order_value - $order->discount_amount }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="{{ route('invoice.print', $order->id) }}" target="_blank" class="btn btn-primary"
                    style="margin-right: 5px;"><i class="fa fa-eye"></i> View Invoice</a>
                <a href="{{ route('invoice.print', $order->id) }}" target="_blank" class="btn btn-success"
                    style="margin-right: 5px;"><i class="fa fa-print"></i> Print Invoice </a>

                {{-- New return route --}}
                @if ($order->is_return != 1)
                    <a onclick="return confirm('Are you sure?')" href="{{ route('orders.return', $order->id) }}"
                        class="btn btn-success" style="margin-right: 5px;"><i class="fa fa-print"></i> Return </a>
                @endif

                {{-- <a href="{{route('receiptCreate', $order->id)}}" target="_blank" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print Receipt of Advance Payment</a> --}}
                <a href="{{ route('receiptCreate', $order->id) }}" target="_blank" class="btn btn-primary pull-right"
                    style="margin-right: 5px;"><i class="fa fa-print"></i> Print Receipt</a>
                {{-- <a href="invoice-print.html" target="_blank" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print Invoice </a> --}}
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>


    </script>
@endpush
