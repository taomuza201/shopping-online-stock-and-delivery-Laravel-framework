@foreach ($amphures  as  $key => $row )
<option value="{{$row->id}}" @if ($hold->holds_amphures == $row->id)
    selected
@endif>{{$row->name_th}}</option>
@endforeach