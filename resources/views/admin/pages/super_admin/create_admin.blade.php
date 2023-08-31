@extends('admin.layouts.two_col')
@section('title','Assign Admin')
@section('content')
<div class="container-fluid">
    <div class="row h-50 align-items-center justify-content-center my-4" style="min-height: 30vh;">
        <div class="col-8 col-sm-6 col-md-4 col-lg-4 col-xl-6">
            <div class="bg-light rounded p-3 p-sm-3 my-3 mx-2">
                <div class=" align-items-center justify-content-between mb-2 my-2">
                    <h3 class="text-primary">Assign a Department Admin</h3>
                    <br>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    @if(Session:: has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                </div>

                <h3>Sign Up</h3>
                <div class="form-floating mb-2">
                    <select name="department" id="department" class="form-control form-control-user">
                        <option value="">Select Department</option>
                        @foreach($departments as $d)
                        <option value="{{ $d->id }}">{{ $d->dept_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-floating mb-2">
                    <select name="teacher" id="teacher" class="form-control form-control-user">
                        <option value="">Select Teacher</option>

                    </select>
                </div>
                <form class="user" method="post" action="{{ url('super-admin/createAdmin/{id}') }}">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <!-- ... (other form elements) -->
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">Assign Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#department").change(function() {
            var department_id = $(this).val();
            $("#teacher").empty();
            var str = '<option value="">Select Teacher</option>';
            $.ajax({
                url: 'http://127.0.0.1:8000/api/users/' + department_id,
                dataType: "json",
                type: 'GET',
                success: function(res) {
                    //    console.log(res.users)
                    var users = res.users;
                    // console.log(users.length)
                    var len = users.length;

                    for (var i = 0; i < len; i++) {
                        str += '<option value= "' + users[i].id + '">' + users[i].first_name + ' ' + users[i].last_name + '</option>';

                    }
                    $("#teacher").html(str);
                }
            });
        });
        // Add an event handler for the "Assign Admin" button click
        // Add an event handler for the "Assign Admin" button click
        $("form.user").submit(function(e) {
            e.preventDefault();
            var userId = $("#teacher").val();
            if (!userId) {
                alert("Please select a teacher.");
                return;
            }

            // Set the correct action URL with the selected user's ID
            $(this).attr("action", 'http://127.0.0.1:8000/super-admin/createAdmin/' + userId);

            // Submit the form
            $.ajax({
                url: $(this).attr("action"),
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val() // Include the CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.href = "{{ url('/dashboard') }}"; // Redirect to dashboard
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert("An error occurred while updating user role.");
                }
            });
        });
    })
</script>
@endsection