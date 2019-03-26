<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src='/jquery-3.2.1.min.js'></script>
</head>
<body>
    查询:<input type="search" id='search_content' placeholder="请输入网址名称"><button id='search'>确定</button>
    <table>
        <tr>
            <th>网站名称</th>
            <th>网站网址</th>
            <th>网站类型</th>
            <th>网站logo</th>
            <th>网站联系人</th>
            <th>网站简介</th>
            <th>操作</th>
        </tr>
        <tbody id='content'>
        @foreach($data as $v)
            <tr>
                <td>{{$v->catenate_name}}</td>
                <td>{{$v->catenate_URL}}</td>
                <td>{{$v->catenate_type}}</td>
                <td><img src="/uploads/{{$v->catenate_Logo}}" alt="未上传图片" witdh='100px' height='80px'></td>
                <td>{{$v->catenate_tel}}</td>
                <td>{{$v->catenate_content}}</td>
                <td>[<a href='#' class='del' test='{{$v->catenate_id}}'>删除</a>]</td>
            </tr>
            @endforeach
            <tr>
                <td colspan='7'>{{ $data->links() }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
<script>
$(function(){
    $(document).on('click','.del',function(){
        var id=$(this).attr('test');
        $.get(
            "{{url('test/del')}}",
            {catenate_id:id},
            function(res){
                if(res==1){
                    alert('删除成功');
                    history.go(0)
                }else{
                    alert('删除失败');
                }
            }
        )
    })

    $(document).on('click','#search',function(){
        var content=$('#search_content').val();
        if(content==''){
            alert('请输入内容');
        }else{
            $.get(
                "{{url('test/search')}}",
                {content:content},
                function(res){
                    $('#content').html(res);
                }
            )
        }
    })
})

</script>