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
            <h4 class="mb-3 mb-md-0">Application Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.application')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Application
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Application Create</h6>
                <form class="forms-sample" action="{{route('administrative.application.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group {{ $errors->has('user_id') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select User Id</label>
								<select class="form-control js-example-basic-single w-100" id="user_id" name="user_id"  style="width: 100%">
									<option selected disabled>Select  user_id</option>
									<option value='1' {{ '1'== old('user_id')  ? 'selected' : ''}}>Yes/Active</option>
									<option value='0' {{ '0'== old('user_id')  ? 'selected' : ''}}>No/Inactive</option>
								</select>
								@if($errors->has('user_id'))
									<label id="user_id-error" class="error mt-2 text-danger" for="user_id">Please select a User</label>
								@endif
						</div>


                        
    
    
                                    <div class="form-group {{ $errors->has('course_type') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Course Type</label>
								<select class="form-control js-example-basic-single w-100" id="course_type" name="course_type"  style="width: 100%">
									<option selected disabled>Select your Course Type</option>
        							<option value='under_graduation' {{ 'under_graduation'== old('under_graduation')  ? 'selected' : ''}}>Under Graduation</option>
        							<option value='post_graduation' {{ 'post_graduation'== old('post_graduation')  ? 'selected' : ''}}>Post Graduation</option>
        						</select>
								@if($errors->has('course_type'))
									<label id="course_type-error" class="error mt-2 text-danger" for="course_type">Please select a Course</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('subject_id') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Subject</label>
								<select class="form-control js-example-basic-single w-100" id="subject_id" name="subject_id"  style="width: 100%">
									<option selected disabled>Select  subject_id</option>
									<option value='1' {{ '1'== old('subject_id')  ? 'selected' : ''}}>Yes/Active</option>
									<option value='0' {{ '0'== old('subject_id')  ? 'selected' : ''}}>No/Inactive</option>
								</select>
								@if($errors->has('subject_id'))
									<label id="subject_id-error" class="error mt-2 text-danger" for="subject_id">Please select a Subject</label>
								@endif
						</div>


                        
    
    
                                    <div class="form-group {{ $errors->has('university_id') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select University Id</label>
								<select class="form-control js-example-basic-single w-100" id="university_id" name="university_id"  style="width: 100%">
									<option selected disabled>Select  university_id</option>
									<option value='1' {{ '1'== old('university_id')  ? 'selected' : ''}}>Yes/Active</option>
									<option value='0' {{ '0'== old('university_id')  ? 'selected' : ''}}>No/Inactive</option>
								</select>
								@if($errors->has('university_id'))
									<label id="university_id-error" class="error mt-2 text-danger" for="university_id">Please select a University</label>
								@endif
						</div>


                        
    
    
                                    <div class="form-group {{ $errors->has('surname') ? 'has-danger' : '' }}">
							<label for="surname">Surname</label>
								<input  type="text" class="form-control form-control-danger" id="surname" name="surname" autocomplete="off" placeholder="Surname" value="{{ old('surname', isset($data) ? $data->surname : '') }}" aria-invalid="true">
								@if($errors->has('surname'))
									<label id="surname-error" class="error mt-2 text-danger" for="surname">Please enter a surname</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('given_name') ? 'has-danger' : '' }}">
							<label for="given_name">Given Name</label>
								<input  type="text" class="form-control form-control-danger" id="given_name" name="given_name" autocomplete="off" placeholder="Given Name" value="{{ old('given_name', isset($data) ? $data->given_name : '') }}" aria-invalid="true">
								@if($errors->has('given_name'))
									<label id="given_name-error" class="error mt-2 text-danger" for="given_name">Please enter a given_name</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
							<label for="email">Email</label>
								<input  type="text" class="form-control form-control-danger" id="email" name="email" autocomplete="off" placeholder="Email" value="{{ old('email', isset($data) ? $data->email : '') }}" aria-invalid="true">
								@if($errors->has('email'))
									<label id="email-error" class="error mt-2 text-danger" for="email">Please enter a email</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('date_of_birth') ? 'has-danger' : '' }}">
							<label for="date_of_birth">Date Of Birth</label>
								<input  type="text" class="form-control form-control-danger" id="date_of_birth" name="date_of_birth" autocomplete="off" placeholder="Date Of Birth" value="{{ old('date_of_birth', isset($data) ? $data->date_of_birth : '') }}" aria-invalid="true">
								@if($errors->has('date_of_birth'))
									<label id="date_of_birth-error" class="error mt-2 text-danger" for="date_of_birth">Please enter a date_of_birth</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('address') ? 'has-danger' : '' }}">
							<label for="address">Address</label>
								<input  type="text" class="form-control form-control-danger" id="address" name="address" autocomplete="off" placeholder="Address" value="{{ old('address', isset($data) ? $data->address : '') }}" aria-invalid="true">
								@if($errors->has('address'))
									<label id="address-error" class="error mt-2 text-danger" for="address">Please enter a address</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('passport_no') ? 'has-danger' : '' }}">
							<label for="passport_no">Passport No</label>
								<input  type="text" class="form-control form-control-danger" id="passport_no" name="passport_no" autocomplete="off" placeholder="Passport No" value="{{ old('passport_no', isset($data) ? $data->passport_no : '') }}" aria-invalid="true">
								@if($errors->has('passport_no'))
									<label id="passport_no-error" class="error mt-2 text-danger" for="passport_no">Please enter a passport_no</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('expiry_date') ? 'has-danger' : '' }}">
							<label for="expiry_date">Expiry Date</label>
								<input  type="text" class="form-control form-control-danger" id="expiry_date" name="expiry_date" autocomplete="off" placeholder="Expiry Date" value="{{ old('expiry_date', isset($data) ? $data->expiry_date : '') }}" aria-invalid="true">
								@if($errors->has('expiry_date'))
									<label id="expiry_date-error" class="error mt-2 text-danger" for="expiry_date">Please enter a expiry_date</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('ielts_score') ? 'has-danger' : '' }}">
							<label for="ielts_score">Ielts Score</label>
								<input  type="text" class="form-control form-control-danger" id="ielts_score" name="ielts_score" autocomplete="off" placeholder="Ielts Score" value="{{ old('ielts_score', isset($data) ? $data->ielts_score : '') }}" aria-invalid="true">
								@if($errors->has('ielts_score'))
									<label id="ielts_score-error" class="error mt-2 text-danger" for="ielts_score">Please enter a ielts_score</label>
								@endif
						</div>

                        
    
    
                                    <div class="form-group {{ $errors->has('passport_file') ? 'has-danger' : '' }}">
							<label for="passport_file">Passport File upload</label>
								<input  type="file" id="passport_file" name="passport_file" class="file-upload-default">
									<div class="input-group col-xs-12">
										<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
											<span class="input-group-append">
												<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
											</span>
									</div>
									@if($errors->has('passport_file'))
										<label id="passport_file-error" class="error mt-2 text-danger" for="passport_file">Please enter a passport_file</label>
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
