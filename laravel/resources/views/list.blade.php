<script src='/jquery-3.2.1.min.js'></script>
@if(Session::get('admin')!='')
    欢迎<span style='color:red'>{{Session::get('admin')}}</span>用户！<a href="{{url('user/pwdedit\\').Session::get('admin')}}">修改密码</a>&nbsp;&nbsp;<a href="{{url('index/index')}}">添加文章</a>&nbsp;&nbsp;<a href="{{url('index/audit')}}">审核({{$num}})</a>
@else
    <a href="{{url('user/login')}}">请登录</a>
@endif
<table border=1>
    <input type="hidden" id='user_name' value="{{Session::get('admin')}}">
    @foreach($data as $v)
        <tr>
            <td><img src="/uploads/{{$v->cover}}" width='100px' height='80px'></td>
            <td>书名: {{$v->username}}</td>
            <td>作者: {{$v->writer}}</td>
            <td>价格: {{$v->price}}</td>
            <td>简介: {{$v->content}}</td>
            @if(!empty($salute))
                @foreach($salute as $vo)
                    @if($vo->user_name==Session::get('admin'))
                        <span class='salute' id='{{$v->id}}'>取消赞</span>
                    @else
                        <span class='salute' id='{{$v->id}}'>点赞</span>
                    @endif
                @endforeach
            @else
                <span class='salute' id='{{$v->id}}'>点赞</span>
            @endif
            @if(!empty($unsalute))
                @foreach($unsalute as $vo)
                    @if($vo->user_name==Session::get('admin'))
                        <span class='unsalute' id='{{$v->id}}'>取消👎</span>
                    @else
                        <span class='unsalute' id='{{$v->id}}'>👎</span>
                    @endif
                @endforeach
            @else
                <span class='unsalute' id='{{$v->id}}'>👎</span>
            @endif
                
            </td>
            <td><a href="{{url('index/lists\\')}}{{$v->id}}">详情</a></td>
        </tr>
    @endforeach
</table>
<script>
    $(function(){
        $(document).on('click','.salute',function(){
            var user_name=$('#user_name').val();
            if(user_name==''){
                alert('请登录后再试');
            }else{
                var content=$(this).text();
                var admin_id=$(this).attr('id');
                if(content=='点赞'){
                    $(this).text('取消赞')
                }else{
                    $(this).text('点赞')
                }
                $.get(
                    "{{url('index/salute')}}",
                    {admin_id:admin_id},
                )
            }
        })
        $(document).on('click','.unsalute',function(){
            var user_name=$('#user_name').val();
            if(user_name==''){
                alert('请登录后再试');
            }else{
                var content=$(this).text();
                var admin_id=$(this).attr('id');
                if(content=='👎'){
                    $(this).text('取消👎')
                }else{
                    $(this).text('👎')
                }
                $.get(
                    "{{url('index/unsalute')}}",
                    {admin_id:admin_id},
                )
            }
        })
    })
</script>