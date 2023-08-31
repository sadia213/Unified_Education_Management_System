<?php $__env->startSection('title', 'Create Sessions'); ?>
<?php $__env->startSection('content'); ?>
    <h1 class="h3 mb-3">Session</h1>

    <div class="card-header">
        Create Sessions <a class="btn btn-info mx-2" href="<?php echo e(url('admin/add_sessions/index')); ?>">List</a>

    </div>

    <div class="card-body">
        <form action="<?php echo e(url('admin/add_sessions/store')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="inputBrandTitle" class="col-sm-3 col-form-label">Session</label>
                <div class="col-8">
                    <select name="session" id="session" class="form-control">
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
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>

            </div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var currentYear = new Date().getFullYear();
            var sessions = [];

            // Generate sessions for the next few years
            for (var year = currentYear; year <= currentYear + 5; year++) {
                sessions.push("Spring-" + year);
                sessions.push("Fall-" + year);
            }

            var select = $("#session");

            function updateOptions(selectedIndex) {
                var selectedSession = select.val();

                select.empty();

                select.append($('<option>', {
                    value: "",
                    text: "Select Session"
                }));

                for (var i = Math.max(selectedIndex - 2, 0); i <= Math.min(selectedIndex + 2, sessions.length -
                    1); i++) {
                    select.append($('<option>', {
                        value: sessions[i],
                        text: sessions[i]
                    }));
                }

                select.val(selectedSession);
            }

            updateOptions(-1);

            select.on("change", function() {
                var selectedIndex = sessions.indexOf($(this).val());
                updateOptions(selectedIndex);
            });
        });
    </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.two_col', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Spring 2023\SD\xampp\htdocs\sadia\resources\views/admin/pages/admin/add_sessions/create.blade.php ENDPATH**/ ?>