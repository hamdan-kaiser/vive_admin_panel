<div class="form-group   @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
    {{"\t\t\t\t\t\t\t"}}<label for="{{$name}}">{{$label}}</label>
    {{"\t\t\t\t\t\t\t"}}<input {{$requiredField ? 'required' : ''}} class="form-control mb-4 mb-md-0"  id="{{$name}}" name="{{$name}}" autocomplete="off" placeholder="{{ucwords($name)}}" value="@{{ old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '') }}"/>
    {{"\t\t\t\t\t\t\t\t"}}<div class="input-group-addon">
    {{"\t\t\t\t\t\t\t\t\t"}}<span class="glyphicon glyphicon-th"></span>
    {{"\t\t\t\t\t\t\t\t"}}</div>
    {{"\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
    {{"\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please enter a {{$name}}</label>
    {{"\t\t\t\t\t\t\t"}}@@endif
    {{"\t\t\t\t\t\t\t"}}</div>
