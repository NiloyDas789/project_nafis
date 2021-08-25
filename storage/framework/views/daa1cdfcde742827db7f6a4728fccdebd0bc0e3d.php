<?php $__env->startSection('content'); ?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
    </section>

    <!-- Main content -->
    </section>
    <section class="invoice">
        <form action="<?php echo e(route('receipts.store', $order->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="<?php echo e($order->id); ?>">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-globe"></i> Accept Payment
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
                    <th style="width:50%">Paid:</th>
                    <td>৳ <?php echo e($order->amount_paid); ?></td>
                </tr>
                <tr>
                    <th style="width:50%">Due:</th>
                    <td>
                        <input style="width:50%" type="text" name="paid_now" id="paid_now" class="form-control" value="<?php echo e($order->order_value - $order->discount_amount - $order->amount_paid); ?>"/>
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
            
            <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print Receipt </button>
        </div>
        </div>

        </form>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/receipt/create.blade.php ENDPATH**/ ?>