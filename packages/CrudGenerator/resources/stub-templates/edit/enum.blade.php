<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
{{"\t\t\t\t\t\t\t"}}<label for="exampleFormControlSelect1">Select {{$label}}</label>
{{"\t\t\t\t\t\t\t\t"}}<select class="form-control js-example-basic-single w-100" id="{{$name}}" name="{{$name}}" {{$requiredField ? 'required' : ''}} style="width: 100%">
{{"\t\t\t\t\t\t\t\t\t"}}<option selected disabled>Select your {{$label}}</option>
        @foreach(explode(",", $item['enumValues']) as $item)
{{"\t\t\t\t\t\t\t"}}<option value='{!! $item  !!}' @{{ '{!! $item !!}'== old('{!! $name !!}', isset($data) ? $data->{!! $name !!} : '')  ? 'selected' : ''}}>{{ ucwords(str_replace('_', ' ', $item)) }}</option>
        @endforeach
{{"\t\t\t\t\t\t"}}</select>
{{"\t\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
{{"\t\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please select a {{ ucwords(explode("_", $name)[0]) }}</label>
{{"\t\t\t\t\t\t\t\t"}}@@endif
{{"\t\t\t\t\t\t"}}</div>
