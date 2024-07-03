<div class="form-group @{{ $errors->has('{!! $name !!}') ? 'has-danger' : '' }}">
{{"\t\t\t\t\t\t\t"}}<label for="{{$name}}">{{$label}} upload</label>
{{"\t\t\t\t\t\t\t\t"}}<input {{$requiredField ? 'required' : ''}} type="file" id="{{$name}}" name="{{$name}}" class="file-upload-default">
{{"\t\t\t\t\t\t\t\t\t"}}<div class="input-group col-xs-12">
{{"\t\t\t\t\t\t\t\t\t\t"}}<input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload">
{{"\t\t\t\t\t\t\t\t\t\t\t"}}<span class="input-group-append">
{{"\t\t\t\t\t\t\t\t\t\t\t\t"}}<button class="file-upload-browse btn btn-primary" type="button">Upload</button>
{{"\t\t\t\t\t\t\t\t\t\t\t"}}</span>
{{"\t\t\t\t\t\t\t\t\t"}}</div>
{{"\t\t\t\t\t\t\t\t\t"}}@@if($errors->has('{{$name}}'))
{{"\t\t\t\t\t\t\t\t\t\t"}}<label id="{{$name}}-error" class="error mt-2 text-danger" for="{{$name}}">Please enter a {{$name}}</label>
{{"\t\t\t\t\t\t\t\t\t"}}@@endif
{{"\t\t\t\t\t\t"}}</div>
