<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>审核</title>
    <script src='/jquery-3.2.1.min.js'></script>
</head>
<body>
    <table>
        <tr>
            <th>评论人</th>
            <th>评论内容</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->user_name}}</td>
            <td>{{$v->comment_content}}</td>
            <td>[<a href="javascript:;" class='audit' id='{{$v->audit_id}}' comment_id='{{$v->id}}' comment_content='{{$v->comment_content}}' user_name='{{$v->user_name}}'>通过</a>]|[<a href="javascript:;" class='audit' id='{{$v->audit_id}}' comment_id='{{$v->id}}' comment_content='{{$v->comment_content}}' user_name='{{$v->user_name}}'>不通过</a>]</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
<script>
    $(function(){
        $(document).on('click','.audit',function(){
            var content=$(this).text();
            var id=$(this).attr('id');
            var comment_content=$(this).attr('comment_content');
            var user_name=$(this).attr('user_name');
            var type='';
            var comment_id=$(this).attr('comment_id');
            if(content=='通过'){
                type='通过';
            }else{
                type='不通过';
            }
            if(type==''){
                alert('发生未知错误');
                return false;
            }
            $.get(
                "{{url('index/auditdo')}}",
                {type:type,comment_content:comment_content,audit_id:id,user_name:user_name,id:comment_id},
                function(res){
                    if(res==1){
                        alert('通过操作成功');
                        history.go(0)
                    }else if(res==2){
                        alert('失败');
                    }else{
                        alert('不通过操作成功')
                        history.go(0)
                    }
                }
            )
        })
    })
</script>