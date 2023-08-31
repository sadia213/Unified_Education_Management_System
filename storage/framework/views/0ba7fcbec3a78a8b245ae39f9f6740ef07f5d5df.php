
<?php $__env->startSection('title','Signin'); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
        <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6">
            <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                <div class=" align-items-center justify-content-between mb-4">
                    <h2 class="text-primary">Welcome Back!</h2>
                    <br><br>
                    <?php if(Session:: has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(Session::get('error')); ?>

                    </div>
                    <?php endif; ?>
                    <form class="user" method="post" action="<?php echo e(url('/user/login')); ?>">
                        <?php echo csrf_field(); ?>
                        <h3>Sign In</h3>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    <label for="">Email address</label>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    <label for=" ">Password</label>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">

                    <a href="">Forgot Password</a>
                </div>
                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                </form>
                <div class="text-center">
                    <a class="big" href="<?php echo e(url('/teacher/register')); ?>">Create a Teacher Account!</a>
                    <br>
                    <a class="big" href="<?php echo e(url('/student/register')); ?>">Create a Student Account!</a>
                </div>
            </diV>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.single_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/auth/login.blade.php ENDPATH**/ ?>