
@foreach($column as $item)
    @php

        $type = $item['type'];
        $name = $item['name'];
        $inputType = $item['inputType'];
        $label = ucwords(str_replace('_', ' ', $name));
        $requiredField = isset($item['isRequired']) ? true : false;
    @endphp
    @if(isset($item['include_in_form']) && $item['include_in_form']==1)
        @if($type=='boolean')
            @if($inputType == 'select')
                {!! view('stub-templates::edit.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType == 'radio')
                {!! view('stub-templates::edit.radio', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @else
                {!! view('stub-templates::edit.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @elseif($inputType=='select')
            @if($type == 'enum')
                {!! view('stub-templates::edit.enum', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif(isset($item['foreign_key']) && isset($item['foreignKeyColumn']))
                {!! view('stub-templates::edit.foreignkey_select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @else
                {!! view('stub-templates::edit.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @else
            @if($inputType=='checkbox')
                {!! view('stub-templates::edit.checkbox', compact('requiredField','label','name','item','type','inputType'))->render() !!}

            @elseif($inputType=='date')
                {!! view('stub-templates::edit.date', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='time')
                {!! view('stub-templates::edit.time', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='file')
                {!! view('stub-templates::edit.file', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='textarea')
                {!! view('stub-templates::edit.textarea', compact('requiredField','label','name','item','type','inputType'))->render() !!}

            @else
                {!! view('stub-templates::edit.default', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @endif

    @endif

@endforeach
