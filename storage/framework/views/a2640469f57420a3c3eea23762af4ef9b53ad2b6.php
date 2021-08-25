<?php $__env->startSection('content'); ?>
<section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
        <?php if(Session::has('customer_add_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('customer_add_message')); ?></p>
                    <?php echo e(Session::forget('customer_add_message')); ?>

                </div>
            </div>
        <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Add New Customer</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <form class="form-horizontal" id="formId" action="<?php echo e(route('customers.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id">
                        <div class="box-body">
                            <div class="form-group">
                                <?php if($errors->has('name')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('mobile')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('mobile')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="mobile" class="col-sm-2 control-label">Mobile</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mobile" name="mobile">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('address')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" name="address" >
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('nid')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('nid')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="nid" class="col-sm-2 control-label">NID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nid" name="nid" >
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('passport')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('passport')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="passport" class="col-sm-2 control-label">Passport</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="passport" name="passport" >
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('comment')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('comment')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="comment" class="col-sm-2 control-label">Comment</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="comment" name="comment">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success pull-right" id="submitId" style="padding-left: 40px; padding-right: 40px">Save</button>
                        </div>
                        <!-- /.box-footer -->
                  </form>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
      </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/customer/create.blade.php ENDPATH**/ ?>