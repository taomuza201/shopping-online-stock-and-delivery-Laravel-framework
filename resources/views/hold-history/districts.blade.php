@foreach ($districts  as  $key => $row )
<option value="{{$row->id}}">{{$row->name_th}}</option>
@endforeach