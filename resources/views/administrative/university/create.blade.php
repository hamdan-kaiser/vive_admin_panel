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
            <h4 class="mb-3 mb-md-0">University Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.university')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                University
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">University Create</h6>
                <form class="forms-sample" action="{{route('administrative.university.store')}} " method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group {{ $errors->has('title') ? 'has-danger' : '' }}">
							<label for="Title">Title</label>
								<input required type="text" class="form-control form-control-danger" id="title" name="title" autocomplete="off" placeholder="Title" value="{{ old('title', isset($data) ? $data->title : '') }}" aria-invalid="true">
								@if($errors->has('title'))
									<label id="Title-error" class="error mt-2 text-danger" for="Title">Please enter a Title</label>
								@endif
						</div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select Location</label>
                        <select class="form-control" name="location_id" id="location_id">

                            @foreach($location as $locationItem)

                                <option value="{{$locationItem['id']}}">{{ucfirst($locationItem['title'])}}</option>

                            @endforeach
                        </select>
                        @if($errors->has('location_id'))
                            <label id="name-error" class="error mt-2 text-danger" for="name">Please select a location</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Attach Subjects</label>
                        <select class="form-control js-example-basic-multiple" name="subject[]" id="subject" multiple="multiple">

                            @foreach($subjects as $subject)

                                <option value="{{$subject['id']}}">{{ucfirst($subject['title'])}}</option>

                            @endforeach
                        </select>
                        @if($errors->has('subject'))
                            <label id="name-error" class="error mt-2 text-danger" for="name">Please select a location</label>
                        @endif
                    </div>


                                    <div class="form-group {{ $errors->has('tution_fee') ? 'has-danger' : '' }}">
							<label for="tution_fee">Tution Fee</label>
								<input required type="text" class="form-control form-control-danger" id="tution_fee" name="tution_fee" autocomplete="off" placeholder="Tution Fee" value="{{ old('tution_fee', isset($data) ? $data->tution_fee : '') }}" aria-invalid="true">
								@if($errors->has('tution_fee'))
									<label id="tution_fee-error" class="error mt-2 text-danger" for="tution_fee">Please enter a tution_fee</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('session') ? 'has-danger' : '' }}">
							<label for="session">Session</label>
								<input required type="text" class="form-control form-control-danger" id="session" name="session" autocomplete="off" placeholder="Session" value="{{ old('session', isset($data) ? $data->session : '') }}" aria-invalid="true">
								@if($errors->has('session'))
									<label id="session-error" class="error mt-2 text-danger" for="session">Please enter a session</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('scholarship') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Scholarship</label>
								<select class="form-control js-example-basic-single w-100" id="scholarship" name="scholarship" required style="width: 100%">
									<option selected disabled>Select  scholarship</option>
									<option value='1' {{ '1'== old('scholarship')  ? 'selected' : ''}}>Yes/Active</option>
									<option value='0' {{ '0'== old('scholarship')  ? 'selected' : ''}}>No/Inactive</option>
								</select>
								@if($errors->has('scholarship'))
									<label id="scholarship-error" class="error mt-2 text-danger" for="scholarship">Please select a Scholarship</label>
								@endif
						</div>


                    <div class="form-group {{ $errors->has('ielts') ? 'has-danger' : '' }}">
                        <label for="exampleFormControlSelect1">is IELTS mandatory?</label>
                        <select class="form-control js-example-basic-single w-100" id="ielts" name="ielts" required style="width: 100%">
                            <option selected disabled>is IELTS mandatory?</option>
                            <option value='1' {{ '1'== old('ielts')  ? 'selected' : ''}}>Yes/Active</option>
                            <option value='0' {{ '0'== old('ielts')  ? 'selected' : ''}}>No/Inactive</option>
                        </select>
                        @if($errors->has('ielts'))
                            <label id="ielts-error" class="error mt-2 text-danger" for="ielts">Please select a status</label>
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
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
@endsection
