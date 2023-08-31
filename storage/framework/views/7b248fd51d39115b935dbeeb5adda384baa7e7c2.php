<?php $__env->startSection('title','Project Status'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="<?php echo e(url('student/project/create')); ?>">Project Submission</a>
            Project Details
        </div>
        <div class="card-body">
            <?php if(session('message')): ?>
            <div class="alert alert-success">
                <span class="close" data-dismiss="alert"></span>
                <strong><?php echo e(session('message')); ?></strong>
            </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Project's Title</th>
                            <th scope="col">Project's Details</th>
                            <th scope="col">Member's Name</th>
                            <th scope="col">Member's ID</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
              
                    <tbody>
                      
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/student/project_submission/index.blade.php ENDPATH**/ ?>