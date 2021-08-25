<?php $__env->startSection('content'); ?>
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <?php if(Session::has('order_delete_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>">
                        <?php echo e(Session::get('order_delete_message')); ?></p>
                    <?php echo e(Session::forget('order_delete_message')); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Bundles</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID #</th>
                                    <th>Bundle Name</th>
                                    
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; ?>
                                <?php $__currentLoopData = $bundles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bundle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($bundle->id); ?></td>
                                        <td><?php echo e($bundle->name); ?></td>
                                        
                                        <td><?php echo e($bundle->created_at); ?></td>
                                        <td><?php echo e($bundle->updated_at); ?></td>

                                        <td>
                                            <span class="">
                                                <a href="<?php echo e(route('bundles.edit', $bundle->id)); ?>">
                                                    <small class="label bg-yellow" style="margin-right: 15px">Edit</small>
                                                </a>
                                                <a onclick="return confirm('Are you sure?')"
                                                    href="<?php echo e(route('bundles.delete', $bundle->id)); ?>">
                                                    <small class="label bg-red" style="margin-right: 15px">Cancel</small>
                                                </a>

                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID #</th>
                                    <th>Bundle Name</th>
                                    <th>Number of product</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp\www\projectNafizVai\resources\views/bundle/index.blade.php ENDPATH**/ ?>