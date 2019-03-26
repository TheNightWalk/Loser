<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
<body>
<form action="{{url('test\testdo')}}" method='post' enctype='multipart/form-data'>
    @csrf
        <table>
            <tr>
                <td>网站名称</td>
                <td><input type="text" name="catenate_name" id="catenate_name"><span id='name_content' style='font-size:12px'></span></td>
            </tr>
            <tr>
                <td>网站网址</td>
                <td><input type="text" name="catenate_URL" id="catenate_URL"><span id='URL_content' style='color:red;font-size:12px'></span></td>
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