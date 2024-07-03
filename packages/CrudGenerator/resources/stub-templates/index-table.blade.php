@foreach ($column as $item)
                                <th>{{ucwords(str_replace('_', ' ', $item['name']))}}</th>
@endforeach
