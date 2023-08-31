
<?php $__env->startSection('title', '/Running Courses'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="h3 mb-3 mx-3">Running Courses</h1>


    <div class="mb-3">
        <label for="inputBrandTitle" class="col-sm-3 col-form-label mx-3">Session</label>
        <div class="col-8">
            <select name="session" id="session" class="form-control mx-3">
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
    <br>
    <div class="card-header">
       <b> Running Courses</b>
    </div>
    <br>
    <div class="table-responsive" id="course" name="course">
        <table class="table text-center">
            <thead>
                <tr>
                    <th scope="col">SL</th>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Course Type</th>
                    <th scope="col">Course Credit</th>
                    <th scope="col">Section</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#session").change(function() {
                var add_session_id = $(this).val();
                $("#course tbody").empty(); // Clear the table body
                if (!add_session_id) {
                    return; // No session selected, so no need to proceed
                }

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/enrollment/' + add_session_id,
                    dataType: "json",
                    type: 'GET',
                    success: function(res) {
                        var add_sessions = res.add_sessions;
                        var len = add_sessions.length;

                        for (var i = 0; i < len; i++) {
                            var newRow = '<tr value="' + add_sessions[i].id +
                                '" data-department="' + add_sessions[i].department_id + '">' +

                                '<td>' + (i + 1) + '</td>' +
                                '<td>' + add_sessions[i].course_code + '</td>' +
                                '<td>' + add_sessions[i].course_name + '</td>' +
                                '<td>' + add_sessions[i].type + '</td>' +
                                '<td>' + add_sessions[i].credit + '</td>' +
                                '<td>' + add_sessions[i].section + '</td>' +
                                '</tr>';
                            $("#course tbody").append(newRow);
                        }
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/teacher/running_courses.blade.php ENDPATH**/ ?>