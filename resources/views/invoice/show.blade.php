<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('public/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();" style="margin: 60px;">
    <div class="wrapper" style="scrollbar-width: none;">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> {{ $settings->company_name }}
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

            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Art. No.</th>
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
                                    <td>{{ $product->price }}</td>
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
                <div class="col-xs-6" style="padding-top: 100px;">
                    <p class="signature text-center mt-5">
                        --------------------------<br>
                        Signature
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                    <p class="lead">Amount Due {{ date_format(date_create($order->return_date), 'd/m/Y') }}</p>

                    <div class="table-responsive">
                        <table class="table">
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
            <p class="tos mt-5" style="padding-top: 100px;">{{ $settings->tos }}</p>
        </section>
    </div>
    <!-- ./wrapper -->
</body>

</html>
