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
            <h4 class="mb-3 mb-md-0">News Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.news')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                News
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">News Create</h6>
                <form class="forms-sample" action="{{route('administrative.news.update',$data->id)}}" method="POST" enctype="multipart/form-data">

                  {!! method_field('PUT') !!}
                    @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
							<label for="title">Title</label>
								<input required type="text" class="form-control form-control-danger" id="title" name="title" autocomplete="off" placeholder="Title" value="{{ old('title', isset($data) ? $data->title : '') }}" aria-invalid="true">
								@if($errors->has('title'))
									<label id="title-error" class="error mt-2 text-danger" for="title">Please enter a title</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('short_description') ? 'has-danger' : '' }}">
							<label for="short_description">Short Description</label>
								<input required type="text" class="form-control form-control-danger" id="short_description" name="short_description" autocomplete="off" placeholder="Short Description" value="{{ old('short_description', isset($data) ? $data->short_description : '') }}" aria-invalid="true">
								@if($errors->has('short_description'))
									<label id="short_description-error" class="error mt-2 text-danger" for="short_description">Please enter a short_description</label>
								@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
							<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="5" required >{{ old('description', isset($data) ? $data->description : '') }}</textarea>
								@if($errors->has('description'))
									<label id="description-error" class="error mt-2 text-danger" for="description">Please enter  a description</label>
								@endif
						</div>


                    
    
                                            <div class="form-group {{ $errors->has('image') ? 'has-danger' : '' }}">
							<label for="image">Image upload</label>
								<input required type="file" id="image" name="image" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
											</span>
									</div>
									@if($errors->has('image'))
										<label id="image-error" class="error mt-2 text-danger" for="image">Please enter a image</label>
									@endif
						</div>

                    
    
                                            <div class="form-group {{ $errors->has('is_active') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Is Active</label>
								<select class="form-control js-example-basic-single w-100" id="is_active" name="is_active" required style="width: 100%">
									<option selected disabled>Select your is_active</option>
									<option value='1' {{ '1'==  old('is_active', isset($data) ? $data->is_active : '')   ? 'selected' : ''}}>Yes/Active</option>
									<option value='0' {{ '0'==  old('is_active', isset($data) ? $data->is_active : '')   ? 'selected' : ''}}>No/Inactive</option>
								</select>
								@if($errors->has('is_active'))
									<label id="is_active-error" class="error mt-2 text-danger" for="is_active">Please select a Is</label>
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

