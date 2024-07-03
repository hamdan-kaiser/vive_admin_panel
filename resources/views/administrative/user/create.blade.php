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
            <h4 class="mb-3 mb-md-0">User Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.user')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                User
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card ">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">User Create</h6>
                <form class="forms-sample" action="{{route('administrative.user.store')}} " method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                        <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
							<label for="name">Name</label>
								<input required type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off" placeholder="Name" value="{{ old('name') }}" aria-invalid="true">
								@if($errors->has('name'))
									<label id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
							<label for="email">Email</label>
								<input required type="email" class="form-control form-control-danger" id="email" name="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" aria-invalid="true">
								@if($errors->has('email'))
									<label id="email-error" class="error mt-2 text-danger" for="email">Please enter a email</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('phone') ? 'has-danger' : '' }}">
							<label for="phone">Phone</label>
								<input required type="text" class="form-control form-control-danger" id="phone" name="phone" autocomplete="off" placeholder="Phone" value="{{ old('phone') }}" aria-invalid="true">
								@if($errors->has('phone'))
									<label id="phone-error" class="error mt-2 text-danger" for="phone">Please enter a phone</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
							<label for="password">Password</label>
								<input required type="password" class="form-control form-control-danger" id="password" name="password" autocomplete="off" placeholder="Password" value="{{ old('password') }}" aria-invalid="true">
								@if($errors->has('password'))
									<label id="password-error" class="error mt-2 text-danger" for="password">Please enter a password</label>
								@endif
						</div>




                        <div class="form-group {{ $errors->has('role_id') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Role</label>
								<select class="form-control js-example-basic-single w-100" id="role_id" name="role_id" required style="width: 100%">
									<option selected disabled>Select your Role</option>
									@foreach($roles as $value)

										<option value='{{ $value->id }}' {{ $value->id== old('role_id', isset($data) ? $data->role_id : '')  ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $value->name)) }}</option>
									@endforeach
								</select>
								@if($errors->has('role_id'))
									<label id="role_id-error" class="error mt-2 text-danger" for="role_id">Please select a Role</label>
								@endif
						</div>
                        <div id="appendArea"></div>



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
