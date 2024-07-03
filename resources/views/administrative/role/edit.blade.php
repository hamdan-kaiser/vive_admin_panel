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
            <h4 class="mb-3 mb-md-0">Role Update</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Roles
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Role Update</h6>
                <form class="forms-sample" action="{{ route('administrative.role.update', $data->id) }}" method="POST" enctype="multipart/form-data">

                  {!! method_field('PUT') !!}
                    @csrf
                    <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off"
                           placeholder="Name" value="{{ old('name', isset($data) ? $data->name : '') }}"
                           aria-invalid="true">
                    @if($errors->has('name'))
                        <label id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</label>
                        @endif

                </div>


                    <div class="form-group">

                        <label for="exampleFormControlSelect1">Select permission</label>
                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                                Select All
                                <i class="input-frame"></i></label>
                        </div>
                        <select class="form-control js-example-basic-multiple" name="permission_id[]" id="permission_id" multiple>

                            @foreach($permissions as $permissionItem)

                                <option value="{{$permissionItem['id']}}"
                                    {{in_array($permissionItem['id'],$data->permissions->pluck('id')->toArray()) ? 'selected' : ''}}>
                                    {{ucfirst($permissionItem['name'])}}</option>

                            @endforeach
                        </select>
                        @if($errors->has('permission_id'))
                            <label id="name-error" class="error mt-2 text-danger" for="name">Please select a permission</label>
                        @endif
                    </div>




                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')
    <script>
        $(".js-example-basic-multiple").select2({
            placeholder: "Select Permission"
        });
        $("#selectAll").click(function(){
            if($("#selectAll").is(':checked') ){
                $("#permission_id > option").prop("selected","selected");
                $("#permission_id").trigger("change");
            }else{
                $("#permission_id > option").removeAttr("selected");

                $("#permission_id").val(null).trigger("change");
            }
        });
    </script>
@endsection

