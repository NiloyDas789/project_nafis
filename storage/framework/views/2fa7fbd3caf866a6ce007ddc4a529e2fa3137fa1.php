<?php $__env->startSection('content'); ?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <?php if(Session::has('customer_delete_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('customer_delete_message')); ?></p>
                    <?php echo e(Session::forget('customer_delete_message')); ?>

                </div>
            </div>
        <?php endif; ?>
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
                    <th>Address</th>
                    <th>NID</th>
                    <th>Passport</th>
                    <th>Comment</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php $cnt = 1; ?>
                  <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($cnt++); ?></td>
                    <td><?php echo e($customer->name); ?></td>
                    <td><?php echo e($customer->mobile); ?></td>
                    <td><?php echo e($customer->address); ?></td>
                    <td><?php echo e($customer->nid); ?></td>
                    <td><?php echo e($customer->passport); ?></td>
                    <td><?php echo e($customer->comment); ?></td>
                    <td>
                      <span class="">
                        <a href="<?php echo e(route('customers.edit', $customer->id)); ?>">
                          <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                        </a>
                        <a onclick="return confirm('Are you sure?')" href="<?php echo e(route('customers.delete', $customer->id)); ?>">
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

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/customer/index.blade.php ENDPATH**/ ?>