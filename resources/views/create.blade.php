@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card-body">
                <form class="forms-sample" action="{{ route('storessbleads') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="join">Creation Date</label>
                            <input type="datetime-local" class="form-control" name="create_date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="join">Updated Date</label>
                            <input type="datetime-local" class="form-control" name="updated_date">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="join">Documented Date</label>
                            <input type="datetime-local" class="form-control" name="documented">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="caseid">Case ID</label>
                            <input type="text" class="form-control" name="caseid">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="uid">UID</label>
                            <input type="text" class="form-control" name="uid">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="sourceid">SOURCE ID</label>
                            <input type="text" class="form-control" name="sourceid">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="iscompleted">IS Completed</label>
                            <input type="text" class="form-control" name="iscompleted">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="casedescription">Case Description</label>
                            <input type="text" class="form-control" name="casedescription">
                        </div>
                        <div class="form-group col-md-4">
                            <label>File upload</label>
                            <input type="file" name="docs" class="file-upload-default">
                            <div class="input-group">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                        {{-- <button type="submit" class="btn btn-gradient-primary me-2">Submit</button> --}}
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ Storage::url('assets/js/file-upload.js')}}"></script>
    <script>
        flatpickr("input[type=datetime-local]");
    </script>
@endsection
