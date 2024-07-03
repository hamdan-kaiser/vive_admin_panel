<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
    <label for="{{$name}}">{{$label}}</label>
    <input {{$requiredField ? 'required' : ''}} class="form-control" data-inputmask="'alias': 'datetime'"
           data-inputmask-inputformat="hh:mm tt" id="{{$name}}" name="{{$name}}" autocomplete="off"
           placeholder="{{ucfirst($name)}}"
           value="@{{ old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '') }}"/>
    @@if($errors->has('{{$name}}'))
        <label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please enter
            a {{$name}}</label>
        @@endif

</div>
