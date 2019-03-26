<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生成绩管理</title>
</head>
<body>
    <form action="indexdo" method='post' enctype=multipart/form-data>
    @csrf
        <table>
            <tr>
                <td>名称：</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>作者：</td>
                <td><input type="text" name="writer"></td>
            </tr>
            <tr>
                <td>价格：</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td>分类：</td>
                <td>
                <select name="type">
                    @foreach($data as $v)
                        <option value="{{$v->name}}">{{$v->name}}</option>
                    @endforeach
                </select>
                </td>
            </tr>
            <tr>
                <td>封面</td>
                <td><input type="file" name="cover"></td>
            </tr>
            <tr>
                <td>简介：</td>
                <td><textarea name="content" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td colspan='2' align='center'><input type="submit" value="提交"></td>
            </tr>
        </table>
    </form>
</body>
</html>