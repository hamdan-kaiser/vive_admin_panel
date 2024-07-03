@php
    $separator = '_';
    $input = preg_replace( '/_[^_]*$/', '', $name );
    $needle = ucwords(str_replace(array('-', '_'), ' ', $input));
    $needle = str_replace(' ', '', $needle);
    $needle= '$'.lcfirst($needle);
@endphp

<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
    {{"\t\t\t\t\t\t\t"}}<label for="exampleFormControlSelect1">Select {{preg_replace('/\W\w+\s*(\W*)$/', '$1', $label)}}</label>
    {{"\t\t\t\t\t\t\t\t"}}<select class="form-control js-example-basic-single w-100" id="{{$name}}" name="{{$name}}" {{$requiredField ? 'required' : ''}} style="width: 100%">
        {{"\t\t\t\t\t\t\t\t\t"}}<option selected disabled>Select your {{preg_replace('/\W\w+\s*(\W*)$/', '$1', $label)}}</option>
        {{"\t\t\t\t\t\t\t\t\t"}}@@foreach({{$needle}} as $value)

            {{"\t\t\t\t\t\t\t\t\t\t"}}<option value='@{{ $value->id }}' @{{ $value->id== old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '')  ? 'selected' : '' }}>@{{ ucwords(str_replace('_', ' ', $value->{!! $item['foreignKeyColumn'] !!})) }}</option>
            {{"\t\t\t\t\t\t\t\t\t"}}@@endforeach
        {{"\t\t\t\t\t\t\t\t"}}</select>
    {{"\t\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
        {{"\t\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please select a {{ ucwords(explode("_", $name)[0]) }}</label>
        {{"\t\t\t\t\t\t\t\t"}}@@endif
    {{"\t\t\t\t\t\t"}}</div>

