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
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" name="fullname">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="datetime">Date/Time</label>
                            <input type="datetime-local" class="form-control" name="datetime">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lender">Please Select Lender</label>
                            <select class="form-control" name="lender" id="lender">
                                <option value="1">N/A</option>
                                <option value="2">Close Brothers Limited</option>
                                <option value="3" id="completed">Clydesdale Finance</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="duration">Vehicle</label>
                            <select class="form-control" name="vehicle" id="vehicle">
                                <option value="1">N/A</option>
                                <option value="2">AUDI A3 S LINE TDI (Fy10uuc)</option>
                                <option value="3" id="vehicle">BMW 330I M SPORT AUTO (Vf19sfk)</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="reference">Reference</label>
                            <input type="text" class="form-control" name="reference">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="link">link</label>
                            <input type="text" class="form-control" name="link">
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
