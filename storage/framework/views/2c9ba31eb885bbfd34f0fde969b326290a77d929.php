
<?php $__env->startSection('main'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if(session('message')): ?>
    <div class="alert alert-success">
        <span class="close" data-dismiss="alert"></span>
        <strong><?php echo e(session('message')); ?></strong>
    </div>
    <?php endif; ?>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pending Users</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pending Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $pending_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></td>
                            <td><?php echo e($u-> email); ?></td>
                            <td><?php echo e($u-> role); ?></td>
                            <td>
                                <?php if( $u->status ): ?>
                                <button class="btn btn-success">Approved</button>

                                <?php else: ?>
                                <button class="btn btn-danger">Not Approved</button>

                                <?php endif; ?>
                            </td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="<?php echo e(url('super-admin/approve-user/'.$u->id)); ?>">Approve</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<!-- Page level plugins -->
<script src="<?php echo e(asset('assets/admin/vendor/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
<!-- Page level custom scripts -->

<script src="<?php echo e(asset('assets/admin/js/demo/datatables-demo.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/super_admin/pending_users.blade.php ENDPATH**/ ?>