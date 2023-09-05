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
                <form class="forms-sample" action="{{ route('home') }}" method="GET" id="filter-form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="join">Start Date</label>
                            <input type="datetime-local" class="form-control" name="start_date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="join">End Date</label>
                            <input input type="datetime-local" class="form-control" name="end_date">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="join">{{ __('Search') }}</label>
                            <input type="text" class="form-control" name="search_term" placeholder="Search SSB leads">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="duration">Please Select Type</label>
                            <select class="form-control" name="duration" id="duration">
                                <option value="1">All</option>
                                <option value="2">Partial</option>
                                <option value="3" id="completed">Completed</option>
                            </select>
                        </div>
                        {{-- <button type="submit" class="btn btn-gradient-primary me-2">Submit</button> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            <a type="button" class="btn btn-sm btn-danger" onclick="clearFilters()">Clear
                                Filters</a>
                            {{-- <button class="btn btn-sm btn-info">Download CSV</button> --}}
                            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                {{-- <input type="file" name="file" class="form-control"> --}}
                                {{-- <a class="btn btn-sm btn-success">Import CSV</a> --}}
                                {{-- <a class="btn btn-sm btn-warning" href="{{ route('export') }}">Download CSV (PDF)</a> --}}
                                <a class="btn btn-sm btn-warning"
                                    href="{{ route('export') }}?duration={{ $duration }}&start_date={{ $start_date }}&end_date={{ $end_date }}">Export
                                    User Data</a>

                            </form>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="com-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Created At</th>
                                        <th>Ended At</th>
                                        <th>Name</th>
                                        <th>Docs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ssb_leads as $ssb_lead)
                                        <tr>
                                            <td>{{ $ssb_lead->id }}</td>
                                            <td>{{ $ssb_lead->created_at }}</td>
                                            <td class="text-danger">{{ $ssb_lead->updated_at }}</td>
                                            <td>{{ $ssb_lead->case_description }}</td>
                                            <td>
                                                @if ($ssb_lead->docs)
                                                    {{-- <a href="{{ Storage::url($ssb_lead->docs) }}" target="_blank">Download Docs</a> --}}
                                                    <a href="{{ asset('storage/' . $ssb_lead->docs) }}"
                                                        target="_blank">Download</a>
                                                    {{-- {{dd($ssb_lead->docs)}} --}}
                                                @else
                                                    No Docs Available
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("input[type=datetime-local]");
        function clearFilters() {
        // Set start_date and end_date to empty values
        document.querySelector('input[name="start_date"]').value = '';
        document.querySelector('input[name="end_date"]').value = '';

        // Set duration to the default value (1 for "All")
        document.querySelector('select[name="duration"]').value = '1';

        // Set search_term to an empty string
        document.querySelector('input[name="search_term"]').value = '';

        // Redirect to the /home route
        window.location.href = "{{ route('home') }}";
    }
    </script>
@endsection
