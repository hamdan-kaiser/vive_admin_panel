<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
{{"\t\t\t\t\t\t\t"}}<label for="{{$name}}">{{$label}}</label>
{{"\t\t\t\t\t\t\t\t"}}<input {{$requiredField ? 'required' : ''}} type="{{$inputType}}" class="form-control form-control-danger" id="{{$name}}" name="{{$name}}" autocomplete="off" placeholder="{{str_replace('_',' ',ucwords($name,'_'))}}" value="@{{ old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '') }}" aria-invalid="true">
{{"\t\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
{{"\t\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please enter a {{$name}}</label>
{{"\t\t\t\t\t\t\t\t"}}@@endif
{{"\t\t\t\t\t\t"}}</div>
