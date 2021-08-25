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
        <?php if(Session::has('settings_update_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('settings_update_message')); ?></p>
                    <?php echo e(Session::forget('settings_update_message')); ?>

                </div>
            </div>
        <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Settings</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <form class="form-horizontal" id="formId" action="<?php echo e(route('settings.update')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <input type="hidden" name="id" value="<?php echo e($settings->id); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <?php if($errors->has('company_name')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('company_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="company_name" class="col-sm-2 control-label">Company Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo e($settings->company_name); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('company_address')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('company_address')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="company_address" class="col-sm-2 control-label">Company Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_address" name="company_address" value="<?php echo e($settings->company_address); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('company_city')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('company_city')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="company_city" class="col-sm-2 control-label">Company City</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="company_city" name="company_city" value="<?php echo e($settings->company_city); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('phone')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e($settings->phone); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="company_name" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" name="email" value="<?php echo e($settings->email); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('invoice_prefix')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('invoice_prefix')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="company_name" class="col-sm-2 control-label">Invoice Prefix</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="invoice_prefix" name="invoice_prefix" value="<?php echo e($settings->invoice_prefix); ?>">
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
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/settings/edit.blade.php ENDPATH**/ ?>