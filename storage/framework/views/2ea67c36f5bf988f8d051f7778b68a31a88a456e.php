<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Receipt</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bower_components/Ionicons/css/ionicons.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/AdminLTE.min.css')); ?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Payment Receipt
              <small class="pull-right">Date: <?php echo e(date('d/m/Y')); ?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong><?php echo e($settings->company_name); ?></strong><br>
              <?php echo e($settings->company_address); ?><br>
              <?php echo e($settings->company_city); ?><br>
              Phone: <?php echo e($settings->phone); ?><br>
              Email: <?php echo e($settings->email); ?>

            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong><?php echo e($order->cname); ?></strong><br>
              <?php echo e($order->address); ?><br>
              Phone: <?php echo e($order->mobile); ?><br>
              Email:
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice <?php echo e($invoice->invoice_id); ?></b><br>
            <br>
            <b>Order ID:</b> <?php echo e($order->id); ?><br>
            
            
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
              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($product->quantity); ?></td>
                      <td><?php echo e($product->title); ?></td>
                      <td><?php echo e($product->art_no); ?></td>
                      <td><?php echo e($product->description); ?></td>
                      <td><?php echo e($product->price); ?></td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Total:</th>
                  <td>৳ <?php echo e($order->order_value); ?></td>
                </tr>
                <tr>
                    <th style="width:50%">Discount:</th>
                    <td>৳ <?php echo e($order->discount_amount); ?></td>
                  </tr>
                <tr>
                  <th>Net Total:</th>
                  <td>৳ <?php echo e($order->order_value - $order->discount_amount); ?></td>
                </tr>
                <tr>
                    <th>Paid Now:</th>
                    <td>৳ <?php echo e($receipt->payment_amount); ?></td>
                </tr>
                <tr>
                    <th>Total Paid:</th>
                    <td>৳ <?php echo e($order->amount_paid); ?></td>
                </tr>
                <tr>
                    <th>Due:</th>
                    <td>৳ <?php echo e($order->order_value - $order->discount_amount - $order->amount_paid); ?></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>

</div>
<!-- ./wrapper -->
</body>
</html>
<?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/receipt/show.blade.php ENDPATH**/ ?>