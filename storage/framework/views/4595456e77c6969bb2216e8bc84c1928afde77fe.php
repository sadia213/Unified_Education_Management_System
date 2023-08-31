<?php $__env->startSection('title','All Sessions'); ?>
<?php $__env->startSection('content'); ?>
<div class="col-12">
    <div class="bg-light rounded h-100 p-4">
        <div class="card-header">
            <a class="btn btn-info mx-2" href="<?php echo e(url('admin/add_sessions/create')); ?>">Add Sessions</a>
            All Sessions <span class="badge rounded-pill bg-danger"> <?php echo e(count($add_sessions)); ?></span>
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
                            <th scope="col">Session</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $sl=0 ?>
                        <?php $__currentLoopData = $add_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(++$sl); ?></td>
                            <td><?php echo e($session->session); ?></td>
                            <td>
                                <?php if($session->status==1): ?>
                                <span class="badge rounded-pill bg-success">Active</span>
                                <a href="<?php echo e(route('session.inactive', $session->id)); ?>"  title="active"><i class="fa-solid fa-circle-check"></i></a>
                                <?php else: ?>
                                <span class="badge rounded-pill bg-danger">Inactive</span>
                                <a href="<?php echo e(route('session.active', $session->id)); ?>"  title="inactive"><i class="fa-solid fa-circle-xmark"></i></a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form style="display:inline" action="<?php echo e(url('admin/add_sessions/delete', ['session' => $session->id])); ?>">
                                    <?php echo csrf_field(); ?>

                                    <button type="submit" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure, you want to delete this?')" style="font-size: 11px">
                                        <i class=" fa fa-trash "></i>
                                    </button>
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
<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/admin/add_sessions/index.blade.php ENDPATH**/ ?>