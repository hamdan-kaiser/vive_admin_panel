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
            <h4 class="mb-3 mb-md-0">Application</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.application.create')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
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
                                <th>Submitted By</th>
                                <th>Course Type</th>
                                <th>Subject</th>
                                <th>University</th>
                                <th>Ielts Score</th>
                                <th>Status</th>

                                <th class="disabled-sorting text-right"></th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="detailsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog-scrollable modal-dialog-centered modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Application Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="contentArea"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $('#datatables tbody').on('click', '.viewDetails', function() {
                var applicationId = $(this).attr('data-id');

                if(applicationId > 0){
                    // AJAX request
                    var url = "{{ route('administrative.application.details',[':applicationId']) }}";
                    url = url.replace(':applicationId',applicationId);
                    // Empty modal data
                    $('#contentArea').empty();
                    $.ajax({
                        url: url,
                        success: function(response){

                            // Add employee details
                            $('.contentArea').html(response);

                            // Display Modal
                            $('#detailsModal').modal('show');
                        }
                    });
                }
            });

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
                ajax: '{{route('administrative.application.data')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user.name', name: 'user.name',"defaultContent": "<i>Not set</i>"},
                    {data: 'course_type', name: 'course_type',"defaultContent": "<i>Not set</i>"},
                    {data: 'subject.title', name: 'subject.title',"defaultContent": "<i>Not set</i>"},
                    {data: 'university.title', name: 'university.title',"defaultContent": "<i>Not set</i>"},
                    {data: 'ielts_score', name: 'ielts_score',"defaultContent": "<i>Not set</i>"},
                    {data: 'job_status.title', name: 'job_status.title',"defaultContent": "<i>Not set</i>"},
                    {data: 'action', name: 'action'},
                ]
            });
        });

        function changeStatus(statusId,applicationId) {
            let Url = '{{ route("administrative.application.update.status") }}';
            swal.fire({
                title: "Are you sure?",
                text: "Once change, you will not be able to recover this state!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.get(Url, { params: { statusId: statusId,applicationId:applicationId } }).then(res => {
                            if(res.data == 'success'){
                                swal.fire({
                                    icon: "success",
                                    button: false,
                                    timer: 1000,
                                });
                                $('#datatables').DataTable().ajax.reload( null, false );
                                $('#detailsModal').modal('hide');
                            }
                        });
                    } else {
                        swal("Your job status unchanged!");
                    }
                });
        }
    </script>
@endsection

