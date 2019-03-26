@foreach($data as $v)
<tr>
    <td>{{$v->catenate_name}}</td>
    <td>{{$v->catenate_URL}}</td>
    <td>{{$v->catenate_type}}</td>
    <td><img src="/uploads/{{$v->catenate_Logo}}" alt="未上传图片" witdh='100px' height='80px'></td>
    <td>{{$v->catenate_tel}}</td>
    <td>{{$v->catenate_content}}</td>
    <td>[<a href='#' class='del' test='{{$v->catenate_id}}'>删除</a>]|[<a href="{{url('test/edit\\')}}{{$v->catenate_id}}">修改</a>]</td>
</tr>
@endforeach
<tr>
    <td colspan='7'>{{ $data->links() }}</td>
</tr>