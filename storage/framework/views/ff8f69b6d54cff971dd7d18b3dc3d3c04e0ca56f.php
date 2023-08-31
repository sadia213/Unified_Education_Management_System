<?php $__env->startSection('title','All Courses'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="<?php echo e(url('admin/courses/create')); ?>">Add Courses</a>
            All Courses <span class="badge rounded-pill bg-danger"> <?php echo e(count($courses)); ?></span>
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
                            <th scope="col">SL</th>
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
              
                    <tbody>
                        <?php $sl=0 ?>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$sl); ?></td>
                            <td><?php echo e($course->course_code); ?></td>
                            <td><?php echo e($course->course_name); ?></td>                           
                            <td>
                                <a href="<?php echo e(url('admin/courses/show',['course'=>$course->id])); ?>"><i class=" fa fa-eye px-1"></i></a>
                                <a href="<?php echo e(url('admin/courses/edit',['course'=>$course->id])); ?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                <form style="display:inline" action="<?php echo e(url('admin/courses/delete', ['course' => $course->id])); ?>">
                                    <?php echo csrf_field(); ?>
                                   
                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('are sure want delete?')" style="font-size: 11px"><i class=" fa fa-trash "></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/admin/courses/index.blade.php ENDPATH**/ ?>