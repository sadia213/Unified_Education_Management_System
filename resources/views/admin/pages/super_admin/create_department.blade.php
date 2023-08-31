@extends('admin.layouts.two_col')
@section('title','Create Department')
@section('content')

<div class="card-header">
    <h3 class="pt-1">Create Department</h3>

</div>
<div class="card-body">
    <form action="{{ url('super-admin/createDept') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Department Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="dept_name" value="">
                
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Short Name</label>
            <div class="col-8">
                <input type="text" class="form-control" id="inputTitle" name="short_name" value="">
                
            </div>
        </div>
        <div class="mb-3">
            <label for="inputTitle" class="col-sm-3 col-form-label">Established</label>
            <div class="col-8">
                <input type="date" class="form-control" id="inputTitle" name="established" value="">
            </div>
        </div>
        <div class="mb-3">
            <div class="col-sm-8">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection