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
            <h4 class="mb-3 mb-md-0">Location Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.location')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Location
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Location Create</h6>
                <form class="forms-sample" action="{{route('administrative.location.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
							<label for="title">Title</label>
								<input required type="text" class="form-control form-control-danger" id="title" name="title" autocomplete="off" placeholder="Title" value="{{ old('title', isset($data) ? $data->title : '') }}" aria-invalid="true">
								@if($errors->has('title'))
									<label id="title-error" class="error mt-2 text-danger" for="title">Please enter a title</label>
								@endif
						</div>

                    <div class="form-check form-group   {{ $errors->has('inside_london') ? 'has-danger' : '' }}">
                        <input type="checkbox" class="form-check-input" id="inside_london" name="inside_london">
                        <label class="form-check-label" for="exampleCheck1">
                            Inside London ?
                        </label>
                        @if($errors->has('inside_london'))
                            <label id="inside_london-error" class="error mt-2 text-danger" for="inside_london">Please select a Inside</label>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page-js')

@endsection
