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
            <h4 class="mb-3 mb-md-0">OtherDcoument Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.otherdcoument')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                OtherDcoument
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">OtherDcoument Create</h6>
                <form class="forms-sample" action="{{route('administrative.otherdcoument.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group {{ $errors->has('type') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Type</label>
								<select class="form-control js-example-basic-single w-100" id="type" name="type" required style="width: 100%">
									<option selected disabled>Select your Type</option>
        							<option value='sop' {{ 'sop'== old('sop')  ? 'selected' : ''}}>Sop</option>
        							<option value='cv' {{ 'cv'== old('cv')  ? 'selected' : ''}}>Cv</option>
        							<option value='personal_reference' {{ 'personal_reference'== old('personal_reference')  ? 'selected' : ''}}>Personal Reference</option>
        							<option value='academic_reference' {{ 'academic_reference'== old('academic_reference')  ? 'selected' : ''}}>Academic Reference</option>
        						</select>
								@if($errors->has('type'))
									<label id="type-error" class="error mt-2 text-danger" for="type">Please select a Type</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('letter') ? 'has-danger' : '' }}">
							<label for="letter">Letter upload</label>
								<input  type="file" id="letter" name="letter" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
											</span>
									</div>
									@if($errors->has('letter'))
										<label id="letter-error" class="error mt-2 text-danger" for="letter">Please enter a letter</label>
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
