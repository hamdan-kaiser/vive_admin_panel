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
            <h4 class="mb-3 mb-md-0">User Edit</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.user')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                User
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">User Create</h6>
                <form class="forms-sample" action="{{route('administrative.user.update',$data->id)}}" method="POST" enctype="multipart/form-data">

                  {!! method_field('PUT') !!}
                    @csrf

                        <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
							<label for="name">Name</label>
								<input required type="text" class="form-control form-control-danger" id="name" name="name" autocomplete="off" placeholder="Name" value="{{ old('name', isset($data) ? $data->name : '') }}" aria-invalid="true">
								@if($errors->has('name'))
									<label id="name-error" class="error mt-2 text-danger" for="name">Please enter a name</label>
								@endif
						</div>


                        <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
							<label for="email">Email</label>
								<input required type="email" class="form-control form-control-danger" id="email" name="email" autocomplete="off" placeholder="Email" value="{{ old('email', isset($data) ? $data->email : '') }}" aria-invalid="true">
								@if($errors->has('email'))
									<label id="email-error" class="error mt-2 text-danger" for="email">Please enter a email</label>
								@endif
						</div>



                        <div class="form-group {{ $errors->has('phone') ? 'has-danger' : '' }}">
							<label for="phone">Phone</label>
								<input required type="text" class="form-control form-control-danger" id="phone" name="phone" autocomplete="off" placeholder="Phone" value="{{ old('phone', isset($data) ? $data->phone : '') }}" aria-invalid="true">
								@if($errors->has('phone'))
									<label id="phone-error" class="error mt-2 text-danger" for="phone">Please enter a phone</label>
								@endif
						</div>





                                            <div class="form-group {{ $errors->has('role_id') ? 'has-danger' : '' }}">
    							<label for="exampleFormControlSelect1">Select Role</label>
    								<select class="form-control js-example-basic-single w-100" id="role_id" name="role_id" required style="width: 100%">
        									<option selected disabled>Select your Role</option>
        									@foreach($roles as $value)

            										<option value='{{ $value->id }}' {{ in_array($value->id,$data->roles->pluck('id')->toArray())  ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $value->name)) }}</option>
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

