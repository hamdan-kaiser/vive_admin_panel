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
            <h4 class="mb-3 mb-md-0">Education Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.education')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Education
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Education Create</h6>
                <form class="forms-sample" action="{{route('administrative.education.update',$data->id)}}" method="POST" enctype="multipart/form-data">

                  {!! method_field('PUT') !!}
                    @csrf
                        <div class="form-group {{ $errors->has('Title') ? 'has-danger' : '' }}">
							<label for="Title">Title</label>
								<input required type="text" class="form-control form-control-danger" id="Title" name="Title" autocomplete="off" placeholder="Title" value="{{ old('Title', isset($data) ? $data->Title : '') }}" aria-invalid="true">
								@if($errors->has('Title'))
									<label id="Title-error" class="error mt-2 text-danger" for="Title">Please enter a Title</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('institution_name') ? 'has-danger' : '' }}">
							<label for="institution_name">Institution Name</label>
								<input required type="text" class="form-control form-control-danger" id="institution_name" name="institution_name" autocomplete="off" placeholder="Institution Name" value="{{ old('institution_name', isset($data) ? $data->institution_name : '') }}" aria-invalid="true">
								@if($errors->has('institution_name'))
									<label id="institution_name-error" class="error mt-2 text-danger" for="institution_name">Please enter a institution_name</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('passing_year') ? 'has-danger' : '' }}">
							<label for="passing_year">Passing Year</label>
								<input required type="text" class="form-control form-control-danger" id="passing_year" name="passing_year" autocomplete="off" placeholder="Passing Year" value="{{ old('passing_year', isset($data) ? $data->passing_year : '') }}" aria-invalid="true">
								@if($errors->has('passing_year'))
									<label id="passing_year-error" class="error mt-2 text-danger" for="passing_year">Please enter a passing_year</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('grade') ? 'has-danger' : '' }}">
							<label for="grade">Grade</label>
								<input required type="text" class="form-control form-control-danger" id="grade" name="grade" autocomplete="off" placeholder="Grade" value="{{ old('grade', isset($data) ? $data->grade : '') }}" aria-invalid="true">
								@if($errors->has('grade'))
									<label id="grade-error" class="error mt-2 text-danger" for="grade">Please enter a grade</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('certificate') ? 'has-danger' : '' }}">
							<label for="certificate">Certificate upload</label>
								<input required type="file" id="certificate" name="certificate" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
											</span>
									</div>
									@if($errors->has('certificate'))
										<label id="certificate-error" class="error mt-2 text-danger" for="certificate">Please enter a certificate</label>
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

@endsection

