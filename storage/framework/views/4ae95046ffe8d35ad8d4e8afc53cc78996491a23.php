<?php $__env->startSection('title', '/Create Project'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="h3 mb-3 mx-3">Project</h1>

    <div class="card-header">
        Create Project <a class="btn btn-info mx-2" href="<?php echo e(url('student/project/index')); ?>">View</a>

    </div>

    <div class="card-body">
        <form action="<?php echo e(url('student/project/store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Project's Title</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="inputTitle" name="project_title" value="">
                    <?php $__errorArgs = ['project_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputDetails" class="col-sm-3 col-form-label">Project's Details</label>
                <div class="col-8">
                    <textarea class="form-control" id="inputDetails" name="project_details" rows="4"></textarea>
                    <?php $__errorArgs = ['project_details'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="group_members" class="col-sm-3 col-form-label">Select Number of Group Members</label>

                <div class="col-8">
                    <select id="group_members" name="group_members" class="form-control">
                        <option value="">Number of group member</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                    <?php $__errorArgs = ['group_members'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div id="member_forms" class="mb-3">
            </div>

            <div class="mb-3">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#group_members').on('change', function() {
                var selectedMembers = $(this).val();
                var memberForms = '';

                for (var i = 1; i <= selectedMembers; i++) {
                    memberForms += `
                    <br>
                    <div class="form-group mb-3">
                        <label for="member_name_${i}" class="col-sm-3 col-form-label" >Member ${i} Name</label><br>
                        <div class="col-8">
                            <input type="text" name="member_name_${i}" class="form-control">
                        </div>
                    </div><br>
                    <div class="form-group mb-3">
                        <label for="member_id_${i}" class="col-sm-3 col-form-label" >Member ${i} Student ID</label><br>
                        <div class="col-8">
                            <input type="text" name="member_id_${i}" class="form-control">
                        </div>
                    </div><br><hr>
                `;
                }

                $('#member_forms').html(memberForms);
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/student/project_submission/create.blade.php ENDPATH**/ ?>