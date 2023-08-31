
<?php $__env->startSection('title', '/Marks Distribution'); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-3">
        <div class="col-8">
            <?php if(session('message')): ?>
                <div class="alert alert-success">
                    <span class="close" data-dismiss="alert"></span>
                    <strong><?php echo e(session('message')); ?></strong>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <h1 class="h3 mb-3 mx-3">Marks Distribution</h1>

    <div class="card-header">
        Marks Distribution
    </div>

    <div class="card-body">

        <form action="<?php echo e(url('teacher/marks-distribute')); ?>" enctype="multipart/form-data" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
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
            <div class="mb-3">
                <div class="col-8">
                    <select name="course" class="form-control mx-3" id="course">
                        <option value="">Select Course</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <div class="col-8">
                    <table id="teacherassign" class="table table-striped table-bordered" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Category Name</th>
                                <th>Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" name="submit" id="button" class="btn btn-primary">Assign</button>
            </div>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#teacherassign').hide();
            $('#button').hide();
            $("#session").change(function() {
                var add_session_id = $(this).val();
                $("#course").empty();
                if (!add_session_id) {
                    $('#teacherassign').hide();
                    $('#button').hide();
                }
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/enrollment/' + add_session_id,
                    dataType: "json",
                    type: 'GET',
                    success: function(res) {
                        var add_sessions = res.add_sessions;
                        var len = add_sessions.length;
                        var str = '<option value="">Select Course</option>';
                        for (var i = 0; i < len; i++) {
                            str += '<option value="' + add_sessions[i].id + '">' +
                                add_sessions[i].course_name + ' - ' + add_sessions[i].section +
                                '</option>';
                        }
                        $("#course").append(str);
                        $('#teacherassign').hide();
                        $('#button').hide();
                    }
                });
            });
            $("#course").change(function() {
                var courseId = $(this).val();
                if (courseId) {
                    $("#dynamic").empty();
                    var html = '<tr>' +
                        '<td><input type="text" name="category[]"></td>' +
                        '<td><input type="number" name="marks[]"></td>' +
                        '<td><button class="btn btn-success add_btn"><i class="fa fa-plus"></i></button></td>' +
                        '</tr>';
                    $('#dynamic').append(html);
                    $('#teacherassign').show();
                } else {
                    $('#teacherassign').hide();
                    $('#button').hide();
                }
            });
            $(document).on('click', '.add_btn', function() {
                var sum = 0;
                $("input[name='marks[]']").each(function() {
                    sum += parseInt($(this).val()) || 0;
                });
                if (sum < 100) {
                    var html = '<tr>' +
                        '<td><input type="text" name="category[]"></td>' +
                        '<td><input type="number" name="marks[]"></td>' +
                        '<td><button class="btn btn-success add_btn"><i class="fa fa-plus"></i></button></td>' +
                        '</tr>';
                    $('#dynamic').append(html);
                    updateAssignButtonVisibility();
                }
            });

            function updateAssignButtonVisibility() {
                var sum = 0;
                $("input[name='marks[]']").each(function() {
                    sum += parseInt($(this).val()) || 0;
                });

                if (sum === 100) {
                    $('#button').show();
                    $('.add_btn').hide();
                } else {
                    $('#button').hide();
                    $('.add_btn').show();
                }
            }
            $('form').on('submit', function(event) {
              
                // Calculate the sum of marks
                var sum = 0;
                $("input[name='marks[]']").each(function() {
                    sum += parseInt($(this).val()) || 0;
                });

                if (sum !== 100) {
                   
                    event.preventDefault(); // Prevent form submission

                } else {
                    $('form')[0].submit(); // Submit the form
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/teacher/marks_distribution.blade.php ENDPATH**/ ?>