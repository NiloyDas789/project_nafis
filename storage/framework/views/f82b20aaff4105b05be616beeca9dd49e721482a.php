

<?php $__env->startSection('content'); ?>
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
              <i class="fa fa-globe"></i> <?php echo e($settings->company_name); ?>

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
            <b>Payment Due:</b> <?php echo e(date_format(date_create($order->return_date),'d/m/Y')); ?><br>
            
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php
            $createdAt = strtotime($order->created_at);
            $returnDate = strtotime($order->return_date);
            $datediff = $returnDate - $createdAt;

            $d =  max(round($datediff / (60 * 60 * 24)), 1);
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
              <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                      <td><?php echo e($product->quantity); ?></td>
                      <td><?php echo e($product->title); ?></td>
                      <td><?php echo e($product->art_no); ?></td>
                      <td><?php echo e($product->description); ?></td>
                      <td>৳ <?php echo e($product->price*$d); ?> (= <?php echo e($d); ?> x <?php echo e($product->price); ?>)</td>
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
            <p class="lead">Amount Due <?php echo e(date_format(date_create($order->return_date),'d/m/Y')); ?></p>

            <div class="table-responsive">
              <table class="table">
                <tr>
                    <th style="width:50%">Date From:</th>
                    <td><?php echo e(date_format(date_create($order->created_at),'d/m/Y')); ?></td>
                </tr>
                <tr>
                    <th style="width:50%">Date To:</th>
                    <td><?php echo e(date_format(date_create($order->return_date),'d/m/Y')); ?></td>
                </tr>

                <tr>
                    <th style="width:50%">Total Days:</th>
                    <td><?php echo e($d); ?></td>
                    </tr>
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
              </table>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-xs-12">
            <a href="<?php echo e(route('invoice.print', $order->id)); ?>" target="_blank" class="btn btn-primary" style="margin-right: 5px;"><i class="fa fa-eye"></i> View Invoice</a>
            <a href="<?php echo e(route('invoice.print', $order->id)); ?>" target="_blank" class="btn btn-success" style="margin-right: 5px;"><i class="fa fa-print"></i> Print Invoice </a>
            
            <a href="<?php echo e(route('receiptCreate', $order->id)); ?>" target="_blank" class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Print Receipt</a>
            
          </div>
        </div>
      </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/order/show.blade.php ENDPATH**/ ?>