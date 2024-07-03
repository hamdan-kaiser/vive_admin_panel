<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
    {{"\t\t\t\t\t\t\t"}}<label for="{{$name}}">{{$label}}</label>
    {{"\t\t\t\t\t\t\t\t"}}<textarea class="form-control" id="{{$name}}" name="{{$name}}" rows="5" {{$requiredField ? 'required' : ''}} >@{{ old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '') }}</textarea>
    {{"\t\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
    {{"\t\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please enter  a {{$name}}</label>
    {{"\t\t\t\t\t\t\t\t"}}@@endif
    {{"\t\t\t\t\t\t"}}</div>
