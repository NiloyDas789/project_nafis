

<?php $__env->startSection('content'); ?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if(Session::has('product_delete_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('product_delete_message')); ?></p>
                    <?php echo e(Session::forget('product_delete_message')); ?>

                </div>
            </div>
        <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Products</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Article / Serial #</th>
                    <th>Unit Price</th>
                    <th>Image</th>
                    <th>In Service</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $cnt = 1; ?>
                  <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($cnt++); ?></td>
                    <td><?php echo e($product->title); ?></td>
                    <td><?php echo e($product->description); ?></td>
                    <td>
                        <?php if($product->stock > 0): ?>
                            <?php echo e($product->stock); ?>

                        <?php else: ?>
                            <small class="label bg-red" style="">In Service</small>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($product->art_no); ?></td>
                    <td><?php echo e($product->unit_price); ?></td>
                    <td>
                        <img src="<?php echo e($product->image_path); ?>" height="50", width="50">
                    </td>
                    <td>
                        <?php if($product->is_in_service != 0): ?>
                            <small class="label bg-red" style="">Yes</small>
                        <?php else: ?>
                            <small class="label bg-green" style="">No</small>
                        <?php endif; ?>
                    </td>
                    <td>
                      <span class="">
                        <a href="<?php echo e(route('stocks.add', $product->id)); ?>">
                            <small class="label bg-green" style="margin-right: 15px">Add Stock</small>
                          </a>
                        <a href="<?php echo e(route('products.edit', $product->id)); ?>">
                          <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                        </a>
                        <a onclick="return confirm('Are you sure?')" href="<?php echo e(route('products.delete', $product->id)); ?>">
                            <small class="label bg-red" style="margin-right: 15px">Delete</small>
                        </a>
                      </span>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Sr.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Stock</th>
                    <th>Article / Serial #</th>
                    <th>Unit Price</th>
                    <th>Image</th>
                    <th>In Service</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/product/index.blade.php ENDPATH**/ ?>