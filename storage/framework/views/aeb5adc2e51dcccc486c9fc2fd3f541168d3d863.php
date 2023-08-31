
<?php $__env->startSection('title','Create Department'); ?>
<?php $__env->startSection('content'); ?>

<div class="card-header">
    <h3 class="pt-1">Create Department</h3>

</div>
<div class="card-body">
    <form action="<?php echo e(url('super-admin/createDept')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Department Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="dept_name" value="">
                
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Short Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="short_name" value="">
                
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Established</label>
            <div class="col-8">
                <input type="date" class="form-control" id="inputTitle" name="established" value="">
            </div>
        </div>
        <div class="mb-3">
            <div class="col-sm-8">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/super_admin/create_department.blade.php ENDPATH**/ ?>