@extends('admin.layouts.two_col')
@section('title', '/Create Project')
@section('content')
    <h1 class="h3 mb-3 mx-3">Project</h1>

    <div class="card-header">
        Create Project <a class="btn btn-info mx-2" href="{{ url('student/project/index') }}">View</a>

    </div>

    <div class="card-body">
        <form action="{{ url('student/project/store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="inputTitle" class="col-sm-3 col-form-label">Project's Title</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="inputTitle" name="project_title" value="">
                    @error('project_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="inputDetails" class="col-sm-3 col-form-label">Project's Details</label>
                <div class="col-8">
                    <textarea class="form-control" id="inputDetails" name="project_details" rows="4"></textarea>
                    @error('project_details')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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
                    @error('group_members')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
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

@endsection
