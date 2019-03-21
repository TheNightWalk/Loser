<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>编辑个人资料</title>
    <meta content="app-id=984819816" name="apple-itunes-app" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
    <link href="css/comm.css" rel="stylesheet" type="text/css" />
    <link href="css/mywallet.css" rel="stylesheet" type="text/css" />
</head>
<body>
    
<!--触屏版内页头部-->
<div class="m-block-header" id="div-header">
    <strong id="m-title">编辑个人资料</strong>
    <a href="javascript:history.back();" class="m-back-arrow"><i class="m-public-icon"></i></a>
    <a href="/" class="m-index-icon"><i class="m-public-icon"></i></a>
</div>

    <div class="wallet-con">
        <div class="w-item">
            <ul class="w-content clearfix">
                <li class="headimg" id='user_img'>
                    <a href="javascript:;">头像</a>
                    <s class="fr"></s>
                    @if(!empty($user_data->user_img))
                        <span class="img fr"></span>
                    @else
                        <span class="fr"><img src="/user_img/{{$user_data->user_img}}" alt=""></span>        
                    @endif
                </li>
                <li id='user_name'>
                    <a href="javascript:;">昵称</a>
                    <s class="fr"></s>
                    <span class="fr">{{$user_data->user_name}}</span>
                </li>
                <li id='index'>
                    <a href="javascript:;">我的主页</a>
                    <s class="fr"></s>
                </li>
                <li>
                    <a href="">手机号码</a>
                    <span class="fr">{{$user_data->user_tel}}</span>
                </li>           
            </ul>     
        </div>
        <div class="quit">
            <a href="">退出登录</a>
        </div>
    </div>

<div class="footer clearfix" style="display:none;">
    <ul>
        <li class="f_home"><a href="/v45/index.do" ><i></i>潮购</a></li>
        <li class="f_announced"><a href="/v45/lottery/" ><i></i>最新揭晓</a></li>
        <li class="f_single"><a href="/v45/post/index.do" ><i></i>晒单</a></li>
        <li class="f_car"><a id="btnCart" href="/v45/mycart/index.do" ><i></i>购物车</a></li>
        <li class="f_personal"><a href="/v45/member/index.do" ><i></i>我的潮购</a></li>
    </ul>
</div>
<script src="js/jquery-1.11.2.min.js"></script>
</body>
</html>
<script src='/jquery-3.2.1.min.js'></script>
<script>
    $(function(){
        $(document).on('click','#user_img',function(){
            alert(1)
        })

        $(document).on('click','#user_name',function(){
            alert(2)
        })
        
        $(document).on('click','#index',function(){
            location.href="{{url('userpage')}}";
        })
    })
</script>