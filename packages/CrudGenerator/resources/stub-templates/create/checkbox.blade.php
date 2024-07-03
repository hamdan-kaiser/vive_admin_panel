<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
    <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" @{{ old('{!! $name !!}') == 1 ? 'checked' : '' }} class="form-check-input" id="{{$name}}" name="{{$name}}" value="1" {{$requiredField ? 'required' : ''}}>
            {{$label}}
        </label>
    </div>
    @@if($errors->has('{{$name}}'))
        <label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please check {{$name}} checkbox </label>
        @@endif
</div>
