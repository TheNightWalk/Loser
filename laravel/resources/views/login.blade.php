<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户登录</title>
</head>
<body>
    <form action="{{url('user/logindo')}}" method='post'>
    @csrf
        <table>
            <tr>
                <td>用户名</td>
                <td><input type="text" name='user_name'></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name='user_pwd'></td>
            </tr>
            <tr>
                <td><input type="submit" value="登录"></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>