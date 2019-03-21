<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>注册验证</title>
<meta content="app-id=984819816" name="apple-itunes-app" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="black" name="apple-mobile-web-app-status-bar-style" />
<meta content="telephone=no" name="format-detection" />
<link href="css/comm.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link href="css/findpwd.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="layui/css/layui.css">
<link rel="stylesheet" href="css/modipwd.css">
<script src="js/jquery-1.11.2.min.js"></script>
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title"></strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>



    <div class="wrapper">
        <form class="layui-form" action="">
            <div class="registerCon">
                <ul>
                    <li class="auth"><em>请输入验证码</em></li>
                    <li><p>我们已向<em class="red">{{$user_tel}}</em>发送验证码短信，请查看短信并输入验证码。</p></li>
                    <li>
                        
                        <input type="text" id="userMobile" placeholder="请输入验证码" value=""/>
                        <a href="javascript:void(0);" class="sendcode" id="btn" disabled=''>获取验证码</a>
                    </li>
                    <li><a id="findPasswordNextBtn" href="javascript:void(0);" class="orangeBtn">确认</a></li>
                    <li>换了手机号码或遗失？请致电客服解除绑定400-666-2110</li>
                </ul>
            </div>
        </form>
    </div>

<script src="layui/layui.js"></script>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form();

  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});

</script>    
<script src='/jquery-3.2.1.min.js'></script>
<script>
    $(function(){
        $(document).on('click','#btn',function(){
            var that = $(this)
            var timeo = 60;
            var timeStop = setInterval(function(){
                timeo--;
                if (timeo>0) {
                    that.text('重新发送' + timeo +'s');
                    that.attr("disabled",true).css("pointer-events","none");//禁止点击
                }else{
                    timeo = 60;//当减到0时赋值为60
                    that.text('获取验证码'); 
                    clearInterval(timeStop);//清除定时器
                    that.attr("disabled",false).css("pointer-events","auto");//移除属性，可点击
                }
            },1000)
            $.get(
                "{{url('regauthdo')}}",
            )
        })

        $(document).on("click",'#findPasswordNextBtn',function(){
            var code=$('#userMobile').val();
            $.get(
                "{{url('regauthdoes')}}",
                {code:code},
                function(res){
                    if(res==1){
                        layer.msg('注册成功',function(){
                            location.href="{{url('login')}}";
                        });
                    }else if(res==3){
                        layer.msg('验证码不正确');
                    }else{
                        layer.msg('注册失败');
                    }
                }
            )
        })
    })
</script>
</body>
</html>
    