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
            <h4 class="mb-3 mb-md-0">Professional Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.professional')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Professional
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Professional Create</h6>
                <form class="forms-sample" action="{{route('administrative.professional.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
							<label for="title">Title</label>
								<input required type="text" class="form-control form-control-danger" id="title" name="title" autocomplete="off" placeholder="Title" value="{{ old('title', isset($data) ? $data->title : '') }}" aria-invalid="true">
								@if($errors->has('title'))
									<label id="title-error" class="error mt-2 text-danger" for="title">Please enter a title</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('company_name') ? 'has-danger' : '' }}">
							<label for="company_name">Company Name</label>
								<input required type="text" class="form-control form-control-danger" id="company_name" name="company_name" autocomplete="off" placeholder="Company Name" value="{{ old('company_name', isset($data) ? $data->company_name : '') }}" aria-invalid="true">
								@if($errors->has('company_name'))
									<label id="company_name-error" class="error mt-2 text-danger" for="company_name">Please enter a company_name</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group input-group date  data-provide='datepicker'  {{ $errors->has('From') ? 'has-danger' : '' }}">
    							<label for="From">From</label>
    							<input required class="form-control mb-4 mb-md-0"  id="From" name="From" autocomplete="off" placeholder="From" value="{{ old('From', isset($data) ? $data->From : '') }}"/>
    								<div class="input-group-addon">
    									<span class="glyphicon glyphicon-th"></span>
    								</div>
    							@if($errors->has('From'))
    								<label id="From-error" class="error mt-2 text-danger" for="From">Please enter a From</label>
    							@endif
    							</div>


                        
    
    
                                    <div class="form-group input-group date  data-provide='datepicker'  {{ $errors->has('To') ? 'has-danger' : '' }}">
    							<label for="To">To</label>
    							<input  class="form-control mb-4 mb-md-0"  id="To" name="To" autocomplete="off" placeholder="To" value="{{ old('To', isset($data) ? $data->To : '') }}"/>
    								<div class="input-group-addon">
    									<span class="glyphicon glyphicon-th"></span>
    								</div>
    							@if($errors->has('To'))
    								<label id="To-error" class="error mt-2 text-danger" for="To">Please enter a To</label>
    							@endif
    							</div>


                        
    
    
                                    <div class="form-group {{ $errors->has('location') ? 'has-danger' : '' }}">
							<label for="location">Location</label>
								<input required type="text" class="form-control form-control-danger" id="location" name="location" autocomplete="off" placeholder="Location" value="{{ old('location', isset($data) ? $data->location : '') }}" aria-invalid="true">
								@if($errors->has('location'))
									<label id="location-error" class="error mt-2 text-danger" for="location">Please enter a location</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('experience_letter') ? 'has-danger' : '' }}">
							<label for="experience_letter">Experience Letter upload</label>
								<input  type="file" id="experience_letter" name="experience_letter" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
											</span>
									</div>
									@if($errors->has('experience_letter'))
										<label id="experience_letter-error" class="error mt-2 text-danger" for="experience_letter">Please enter a experience_letter</label>
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
