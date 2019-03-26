<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加友情链接</title>
    <script src='/jquery-3.2.1.min.js'></script>
    <script>
        $(function(){
            var catenate_name=false;
            var catenate_URL=false;
            var catenate_tel=false;
            $(document).on('blur','#catenate_name',function(){
                var content=$(this).val();
                if(content==''){
                    $('#name_content').text('!网站名称不能为空');
                    $('#name_content').prop('style','color:red;font-size:12px');
                    catenate_name=false
                }else{
                    $('#name_content').text('√');
                    $('#name_content').prop('style','color:green;font-size:12px');
                    catenate_name=true;
                }
            })

            $(document).on('blur','#catenate_URL',function(){
                var content=$(this).val();
                var reg=/^(http|https|ftp)+(:\/\/)+(www\.)+([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$/;
                if(content==''){
                    $('#URL_content').text('!网站网址不能为空');
                    $('#URL_content').prop('style','color:red;font-size:12px');
                    catenate_URL=false
                }else if(!reg.test(content)){
                    $('#URL_content').text('正确网址格式为：http://www.baidu.com');
                    $('#URL_content').prop('style','color:red;font-size:12px');
                    catenate_URL=false
                }else{
                    $('#URL_content').text('√');
                    $('#URL_content').prop('style','color:green;font-size:12px');
                    catenate_URL=true
                }
            })

            $(document).on('blur','#catenate_tel',function(){
                var content=$(this).val();
                var reg=/^1[34578]\d{9}$/;
                if(content==''){
                    $('#tel_content').text('!联系人不能为空');
                    $('#tel_content').prop('style','color:red;font-size:12px');
                    catenate_tel=false
                }else if(!reg.test(content)){
                    $('#tel_content').text('请输入正确的电话号码');
                    $('#tel_content').prop('style','color:red;font-size:12px');
                    catenate_tel=false
                }else{
                    $('#tel_content').text('√');
                    $('#tel_content').prop('style','color:green;font-size:12px');
                    catenate_tel=true
                }
            })

            $("form").submit(function(e){
                return catenate_URL&&catenate_name&&catenate_tel;
            });
        })
    </script>
</head>
<body>
    <form action="{{url('test\testdo')}}" method='post' enctype='multipart/form-data'>
    @csrf
        <table>
            <tr>
                <td>网站名称</td>
                <td><input type="text" name="catenate_name" id="catenate_name"><span id='name_content' style='font-size:12px'>!请输入站址名称</span></td>
            </tr>
            <tr>
                <td>网站网址</td>
                <td><input type="text" name="catenate_URL" id="catenate_URL"><span id='URL_content' style='color:red;font-size:12px'>!请输入站址网址</span></td>
            </tr>
            <tr>
                <td>链接形式</td>
                <td><input type="radio" name="catenate_type" value="LOGO链接" checked>LOGO链接<input type="radio" name="catenate_type" value="文字链接">文字链接</td>
            </tr>
            <tr>
                <td>图片Logo</td>
                <td><input type="file" name="catenate_Logo" id=""></td>
            </tr>
            <tr>
                <td>网站联系人</td>
                <td><input type="text" name="catenate_tel" id="catenate_tel"><span id='tel_content'></span></td>
            </tr>
            <tr>
                <td>网站介绍</td>
                <td><textarea name="catenate_content" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td><input type="radio" name="is_show" value='是' checked>是<input type="radio" name="is_show" value='否'>否</td>
            </tr>
            <tr>
                <td><input type="submit" value="添加" id='form'></td>
                <td><input type="button" value="取消"></td>
            </tr>
        </table>
    </form>
</body>
</html>