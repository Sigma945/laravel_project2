@foreach($list as $data)
    <tr>
        <td class="text-center"><input type="checkbox" class="form-check-input chk" name="id[]" value="{{ $data->id }}"></td>
        <td class="text-center">{{ $data->layer1_name  }}</td> 
        <td class="text-center"><a href="/admin/layer1/edit/{{ $data->id }}" class="btn btn-success">修改</td>
    </tr>
@endforeach