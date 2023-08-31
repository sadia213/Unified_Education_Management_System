
<?php $__env->startSection('title','Create Teacher Account'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
        <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6">
            <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                <div class=" align-items-center justify-content-between mb-2 my-2">
                    <h3 class="text-primary">Create a Teacher Account!</h3>
                    <br>
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(Session::get('success')); ?>

                    </div>
                    <?php endif; ?>
                    <?php if(Session:: has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(Session::get('error')); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <form class="user" method="post" action="<?php echo e(url('/super-admin/createTeacher')); ?>">
                    <?php echo csrf_field(); ?>
                    <h3>Sign Up</h3>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control form-control-user" name="first_name" id="exampleFirstName" placeholder="First Name">
                            <label for="">First Name</label>
                        </div>
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control form-control-user" name="last_name" id="exampleLastName" placeholder="Last Name">
                            <label for="">Last Name</label>
                        </div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email Address">
                        <label for="">Email Address</label>
                    </div>
                    <div class="form-floating mb-2">
                        <select name="department" id="" class="form-control form-control-user">
                            <option value="">Select Department</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>"><?php echo e($d->dept_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="form-floating mb-2">
                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                            <label for="">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="conf_password">
                            <label for="">Repeat Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">Register Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/super_admin/create_teacher.blade.php ENDPATH**/ ?>