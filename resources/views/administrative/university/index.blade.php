@extends('administrative.layouts.master')
@section('page-css')

@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('administrative.dashboard') }}">Dashboard</a></li>
        @php
            $link = url('/');
        @endphp

        @foreach(request()->segments() as $segment)
            @php
                $link .= "/" . request()->segment($loop->iteration);
            @endphp
            @if(rtrim(request()->route()->getPrefix(), '/') != $segment && ! preg_match('/[0-9]/', $segment))
                @if($loop->last)
                    <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" {{ $loop->last ? 'aria-current="page"' : '' }}>
                        @if($loop->last)
                            {{ $segment}}
                        @else
                            <a href="{{ $link }}">{{ $segment }}</a>
                        @endif
                    </li>
                @endif
            @endif
        @endforeach

        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">University</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            @if(\Session::has('success'))
                <div class="alert alert-success">
                    {{ \Session::get('success') }}
                    @php
                        \Session::forget('success');
                    @endphp
                </div>
            @endif
            <div>
                <form action="{{ route('administrative.university.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group float-left">
                        <label for="file_url_web">Import File Upload</label>
                        <input type="file" required name="excel_file" class="file-upload-default" id="excel_file">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
                            <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-success" type="button">Upload</button>
                                </span>
                        </div>
                        @if($errors->has('excel_file'))
                            <span class="text-danger">{{ $errors->first('excel_file') }}</span>
                        @endif
                    </div>
                    <button class="btn btn-success btn-icon-text float-right" style="margin: 32px 32px 40px 10px;" type="submit">Import</button>
                </form>
            </div>
            <a href="{{route('administrative.university.create')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="plus-square"></i>
                Add New
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> </h6>
                    <div class="table-responsive">
                        <table id="datatables" class="table">
                            <thead>
                            <tr>
                                <th> SL</th>
                                <th>Title</th>
                                <th>Subjects</th>
                                <th>Location</th>
                                <th>Tution Fee</th>
                                <th>Session</th>
                                <th>Scholarship</th>
                                <th>IELTS</th>
                                <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                },
                processing: true,
                serverSide: true,
                ajax: '{{route('administrative.university.data')}}',
                console.log(data);
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'title', name: 'Title'},
                    {data: 'subjects', name: 'subjects'},
                    {data: 'location.title', name: 'location.title'},
                    {data: 'tution_fee', name: 'tution_fee'},
                    {data: 'session', name: 'session'},
                    {data: 'scholarship', name: 'scholarship'},
                    {data: 'ielts', name: 'ielts'},
                    {data: 'action', name: 'action'}
                ]
            });
        });

        function deleteData(rowid) {
            let url = '{{ route("administrative.university.destroy", ":id") }}';
            url = url.replace(':id', rowid);
            swal.fire({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.delete(url).then(res => {
                            if(res.data == 'success'){
                                swal.fire({
                                    icon: "success",
                                    button: false,
                                    timer: 1000,
                                });
                                $('#datatables').DataTable().ajax.reload( null, false );
                            }
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });
        }
    </script>
@endsection

