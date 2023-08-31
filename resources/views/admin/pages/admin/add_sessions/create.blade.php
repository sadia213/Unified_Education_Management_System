@extends('admin.layouts.two_col')
@section('title', 'Create Sessions')
@section('content')
    <h1 class="h3 mb-3">Session</h1>

    <div class="card-header">
        Create Sessions <a class="btn btn-info mx-2" href="{{ url('admin/add_sessions/index') }}">List</a>

    </div>

    <div class="card-body">
        <form action="{{ url('admin/add_sessions/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputBrandTitle" class="col-sm-3 col-form-label">Session</label>
                <div class="col-8">
                    <select name="session" id="session" class="form-control">
                    </select>
                    @error('session')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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


@endsection
