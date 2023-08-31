
<?php $__env->startSection('title', 'Assign Admin'); ?>
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
            <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6 py-5">
                <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                    <div class=" align-items-center justify-content-between mb-2 my-2">
                        <h3 class="text-primary">Assign Admin</h3>
                        <br>
                        <?php if(Session::has('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(Session::get('success')); ?>

                            </div>
                        <?php endif; ?>
                        <?php if(Session::has('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(Session::get('error')); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <form class="user" method="post" action="<?php echo e(url('admin/userAdmin')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-floating mb-3">
                            <h3>Teachers of
                                <?php echo e($user_department_name); ?>

                            </h3>
                        </div>

                        <div class="mb-3">
                            <label for="inputPicture" class="col-sm-3 col-form-label">Teacher's Name</label>
                            <div class="col-12">
                                <select name="user_id" class="form-select py-2 w-200 mb-3">
                                    <option>Select Teacher</option>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($u->id); ?>"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-3 mt-3">Assign Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/admin/admin_user.blade.php ENDPATH**/ ?>