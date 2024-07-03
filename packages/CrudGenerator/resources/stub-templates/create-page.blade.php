@foreach($column as $item)
    @php

        $type = $item['type'];
        $name = $item['name'];
        $inputType = $item['inputType'];
        $label = ucwords(str_replace('_', ' ', $item['input_label']));
        $requiredField = isset($item['isRequired']) ? true : false;
    @endphp

    @if(isset($item['include_in_form']) && $item['include_in_form']==1)

        @if($type=='boolean')
            @if($inputType == 'select')
                {!! view('stub-templates::create.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType == 'radio')
                {!! view('stub-templates::create.radio', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @else
                {!! view('stub-templates::create.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @elseif($inputType=='select')
            @if($type == 'enum')
                {!! view('stub-templates::create.enum', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif(isset($item['foreign_key']) && isset($item['foreignKeyColumn']))
                {!! view('stub-templates::create.foreignkey_select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @else
                {!! view('stub-templates::create.select', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @else
            @if($inputType=='checkbox')
                {!! view('stub-templates::create.checkbox', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='date')
                {!! view('stub-templates::create.date', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='time')
                {!! view('stub-templates::create.time', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='file')
                {!! view('stub-templates::create.file', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @elseif($inputType=='textarea')
                {!! view('stub-templates::create.textarea', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @else
                {!! view('stub-templates::create.default', compact('requiredField','label','name','item','type','inputType'))->render() !!}
            @endif
        @endif
    @endif

@endforeach
