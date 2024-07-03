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
            <h4 class="mb-3 mb-md-0">Article Create</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{route('administrative.article')}}" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <i class="btn-icon-prepend" data-feather="server"></i>
                Article
            </a>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 grid-margin stretch-card offset-md-2">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Article Create</h6>
                <form class="forms-sample" action="{{route('administrative.article.store')}} " method="POST">
                    @csrf
                        <div class="form-group {{ $errors->has('type') ? 'has-danger' : '' }}">
							<label for="exampleFormControlSelect1">Select Type</label>
								<select class="form-control js-example-basic-single w-100" id="type" name="type" required style="width: 100%">
									<option selected disabled>Select your Type</option>
        							<option value='about_us' {{ 'about_us'== old('about_us')  ? 'selected' : ''}}>About Us</option>
        							<option value='basic_requirement' {{ 'basic_requirement'== old('basic_requirement')  ? 'selected' : ''}}>Basic Requirement</option>
        							<option value='company_service' {{ 'company_service'== old('company_service')  ? 'selected' : ''}}>Company Service</option>
        							<option value='terms' {{ 'terms'== old('terms')  ? 'selected' : ''}}>Terms</option>
        							<option value='privacy' {{ 'privacy'== old('privacy')  ? 'selected' : ''}}>Privacy</option>
        						</select>
								@if($errors->has('type'))
									<label id="type-error" class="error mt-2 text-danger" for="type">Please select a Type</label>
								@endif
						</div>




                                    <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
    							<label for="description">Description</label>
    								<textarea class="form-control" id="description" name="description" rows="5"  >{{ old('description', isset($data) ? $data->description : '') }}</textarea>
    								@if($errors->has('description'))
    									<label id="description-error" class="error mt-2 text-danger" for="description">Please enter  a description</label>
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
    <script>
        tinymce.init({
            selector: '#description',
            height: 400,
            theme: 'silver',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
            image_advtab: true,
            templates: [{
                title: 'Test template 1',
                content: 'Test 1'
            },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            content_css: []
        });
    </script>
@endsection
