

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
        <?php if(Session::has('product_update_message')): ?>
            <div class="row">
                <div class="col-md-6">
                    <p class="alert <?php echo e(Session::get('alert-class', 'alert-success')); ?>"><?php echo e(Session::get('product_update_message')); ?></p>
                    <?php echo e(Session::forget('product_update_message')); ?>

                </div>
            </div>
        <?php endif; ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Update Product</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-md-8">
                    <form class="form-horizontal" id="formId" action="<?php echo e(route('products.update', $product->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo e(method_field('PUT')); ?>

                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <?php if($errors->has('title')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="<?php echo e($product->title); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('description')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('description')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" rows="3" ><?php echo e($product->description); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('quantity')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('quantity')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="quantity" class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo e($product->stock); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('art_no')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('art_no')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="art_no" class="col-sm-2 control-label">Article / Serial #</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="art_no" name="art_no" value="<?php echo e($product->art_no); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('price')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('price')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="price" class="col-sm-2 control-label">Unit Price</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo e($product->unit_price); ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php if($errors->has('is_in_service')): ?>
                                    <span class="invalid-feedback" style="" role="alert">
                                        <strong style="color: red">* <?php echo e($errors->first('is_in_service')); ?></strong>
                                    </span>
                                <?php endif; ?>
                                <label for="is_in_service" class="col-sm-2 control-label">In Service</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="is_in_service" name="is_in_service">
                                        <option value="1" <?php echo e($product->is_in_service == 1 ? 'selected' : ''); ?>>Yes</option>
                                        <option value="0" <?php echo e($product->is_in_service == 0 ? 'selected' : ''); ?>>No</option>
                                      </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="col-sm-2 control-label custom-file-label" for="customFile">Choose file</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="custom-file-input" id="customFile" name="customFile">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="custom-file">
                                    <label class="col-sm-2 control-label custom-file-label" for="customFile">Previous Image</label>
                                    <div class="col-sm-10">
                                        <img src="<?php echo e(asset($product->image_path)); ?>" height="300" width="300">
                                    </div>
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

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/manvspes/lense.nehal.xyz/resources/views/product/edit.blade.php ENDPATH**/ ?>