<!DOCTYPE html>
<html lang="en">
<head>
    <script src='/jquery-3.2.1.min.js'></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data->username}}详情</title>
</head>
<body>
    <table border='1'>
        <tr>
            <th>书名</th>
            <th>作者</th>
            <th>价格</th>
            <th>类型</th>
            <th>封面</th>
            <th>详情介绍</th>
        </tr>
        <tr>
            <td>{{$data->username}}</td>
            <td>{{$data->writer}}</td>
            <td>{{$data->price}}</td>
            <td>{{$data->type}}</td>
            <td><img src="/uploads/{{$data->cover}}" alt="图片已损坏" width='100px' height='80px'></td>
            <td>{{$data->content}}</td>
        </tr>
        <tr>
            <td rowspan='2'><span align='top'>评论</span></td>
            <td colspan='5'>
                @if(empty($comment))
                    暂无评论
                @else
                    @foreach($comment as $v)
                        <p>{{$v->user_name}}:{{$v->comment_content}}</p>
                    @endforeach
                @endif
            </td>
        </tr>
        <tr>
            <input type="hidden" id='admin' value="{{$data->id}}">
            <input type="hidden" id='admin_name' value="{{Session::get('admin')}}">
            <td colspan='6'><input type="text" id='comment'><input type="button" value="发送" id='res'></td>
        </tr>
    </table>
</body>
</html>
<script>
    $(function(){
        $(document).on('click','#res',function(){
            var id=$('#admin').val();
            var content=$('#comment').val();
            var admin=$('#admin_name').val();
            var user_name='{{$data->user_name}}'
            var admin_name="{{Session::get('admin')}}"
            if(content==''){
                alert('请输入有效内容');
            }else if(admin==''){
                alert('请登录后再试');
            }else{
                $.get(
                    "{{url('index/listsdo')}}",
                    {id:id,comment_content:content,user_name:user_name,aulit_name:admin_name},
                    function(res){
                        if(res==1){
                            alert('评论成功');
                            history.go(0);
                        }else if(res==2){
                            alert('评论失败');
                        }else{
                            alert('评论成功，待添加人审核');
                            history.go(0);
                        }
                    }
                )
            }
        })
    })
</script>