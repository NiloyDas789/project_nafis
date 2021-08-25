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
        <form action="{{route('receipts.store', $order->id)}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$order->id}}">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Accept Payment
              <small class="pull-right">Date: {{date('d/m/Y')}}</small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>{{$settings->company_name}}</strong><br>
              {{$settings->company_address}}<br>
              {{$settings->company_city}}<br>
              Phone: {{$settings->phone}}<br>
              Email: {{$settings->email}}
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong>{{$order->cname}}</strong><br>
              {{$order->address}}<br>
              Phone: {{$order->mobile}}<br>
              Email:
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice {{$invoice->invoice_id}}</b><br>
            <br>
            <b>Order ID:</b> {{$order->id}}<br>
            {{-- <b>Payment Due:</b> {{date_format(date_create($order->return_date),'m/d/Y')}}<br> --}}
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
                <th>Article No.</th>
                <th>Description</th>
                <th>Subtotal</th>
              </tr>
              </thead>
              <tbody>
              @foreach ($products as $product)
                  <tr>
                      <td>{{$product->quantity}}</td>
                      <td>{{$product->title}}</td>
                      <td>{{$product->art_no}}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->price}}</td>
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
            {{-- <p class="lead">Amount Due {{date_format(date_create($order->return_date),'d/m/Y')}}</p> --}}

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total:</th>
                  <td>৳ {{$order->order_value}}</td>
                </tr>
                <tr>
                    <th style="width:50%">Discount:</th>
                    <td>৳ {{$order->discount_amount}}</td>
                </tr>
                <tr>
                    <th>Net Total:</th>
                    <td>৳ {{$order->order_value - $order->discount_amount}}</td>
                  </tr>
                <tr>
                    <th style="width:50%">Paid:</th>
                    <td>৳ {{$order->amount_paid}}</td>
                </tr>
                <tr>
                    <th style="width:50%">Due:</th>
                    <td>
                        <input style="width:50%" type="text" name="paid_now" id="paid_now" class="form-control" value="{{$order->order_value - $order->discount_amount - $order->amount_paid}}"/>
                    </td>
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
            {{-- <a href="" target="_blank" class="btn btn-success pull-right" style=""><i class="fa fa-print"></i> Print Receipt</a> --}}
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print Receipt </button>
        </div>
        </div>

        </form>
</section>

@endsection

@push('js')
<script>


</script>
@endpush
