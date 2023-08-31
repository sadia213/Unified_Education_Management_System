<?php $__env->startSection('title', '/Assign Courses'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="h3 mb-3 mx-3">Assigning Course</h1>

    <div class="card-header">
        Assign Courses <a class="btn btn-info mx-2" href="<?php echo e(url('admin/assigned_courses/index')); ?>">List</a>
    </div>

    <div class="card-body">
        <form action="<?php echo e(url('admin/assigned_courses/store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="inputBrandTitle" class="col-sm-3 col-form-label">Session</label>
                <div class="col-8">
                    <select name="add_session_id" id="" class="form-control">
                        <option value="">Select Session</option>
                        <?php $__currentLoopData = $add_sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->session); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['session'];
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
                <label for="inputPicture" class="col-sm-3 col-form-label">Course Name</label>
                <div class="col-8">
                    <select name="course_id" class="form-select" id="courseSelect">
                        <option></option>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($c->id); ?>" data-department="<?php echo e($c->department_id); ?>"
                                class="course-option"><?php echo e($c->course_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Section</label>
                <div class="col-8">
                    <select name="section" id="" class="form-control">
                        <option value="">Select Section</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                    <?php $__errorArgs = ['section'];
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
                <label for="inputPicture" class="col-sm-3 col-form-label">Teacher's Name</label>
                <div class="col-8">
                    <select name="user_id" class="form-select">
                        <option></option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($u->id); ?>"><?php echo e($u->first_name); ?> <?php echo e($u->last_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const departmentId = <?php echo e($user_department_id); ?>;
            const coursesSelect = document.querySelector('select[name="course_id"]');
            const usersSelect = document.querySelector('select[name="user_id"]');

            coursesSelect.addEventListener('change', filterUsersByDepartment);

            function filterUsersByDepartment() {
                const selectedCourseId = coursesSelect.value;
                const filteredUsers = allUsers.filter(user => user.department_id === departmentId && (
                    selectedCourseId === '' || user.course_id === parseInt(selectedCourseId)));
                populateUsersDropdown(filteredUsers);
            }

            function populateUsersDropdown(users) {
                usersSelect.innerHTML = '<option></option>';
                users.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = `${user.first_name} ${user.last_name}`;
                    usersSelect.appendChild(option);
                });
            }

            filterUsersByDepartment();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/admin/sessions/create.blade.php ENDPATH**/ ?>