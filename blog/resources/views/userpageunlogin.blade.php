<!DOCTYPE html>
@extends('master')
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=no, maximum-scale=1.0" />
    <title>我的潮购</title>
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style" />
    <meta content="telephone=no" name="format-detection" />
</head>
@section('content')
<body class="g-acc-bg">
    
    <div class="welcome" style="display: none">
        <p>Hi，等你好久了！</p>
        <a href="" class="orange">登录</a>
        <a href="" class="orange">注册</a>
    </div>

    <div class="welcome">
        <i class="set"></i>
        <div class="login-img clearfix">
            <ul>
                <li><img src="images/goods2.jpg" alt=""></li>
                <li class="name">
                    <h3><a href="{{url('login')}}">请登录！</a></h3>
                </li>
                <li class="next fr"><s></s></li>
            </ul>
        </div>
        <div class="chao-money">
            <ul class="clearfix">
                <li class="br">
                    <p>潮购值</p>
                    <span>0</span>
                </li>
                <li class="br">
                    <p>余额（元）</p>
                    <span>0</span>
                </li>
                <li>
                    <a href="{{url('login')}}" class="recharge">去充值</a>
                </li>
            </ul>
        </div>

    </div>
    <!--获得的商品-->
    
    <!--导航菜单-->
    
    <div class="sub_nav marginB person-page-menu">
        <a href="{{url('login')}}"><s class="m_s1"></s>潮购记录<i></i></a>
        <a href="{{url('login')}}"><s class="m_s2"></s>获得的商品<i></i></a>
        <a href="{{url('login')}}"><s class="m_s3"></s>我的晒单<i></i></a>
        <a href="{{url('login')}}"><s class="m_s4"></s>我的钱包<i></i></a>
        <a href="{{url('login')}}"><s class="m_s5"></s>收货地址<i></i></a>
        <a href="{{url('login')}}" class="mt10"><s class="m_s6"></s>帮助与反馈<i></i></a>
        <a href="{{url('login')}}"><s class="m_s7"></s>二维码分享<i></i></a>
        <p class="colorbbb">客服热线：400-666-2110  (工作时间9:00-17:00)</p>
    </div>

    <div class="footer clearfix">
    <div class="footer clearfix">
        <ul>
            <li class="f_home"><a href="{{url('/')}}"><i></i>潮购</a></li>
            <li class="f_announced"><a href="{{url('allshops')}}" ><i></i>所有商品</a></li>
            <li class="f_car"><a id="btnCart" href="{{url('shopcart')}}"><i></i>购物车</a></li>
            <li class="f_personal"><a href="{{url('userpage')}}"   class="hover"><i></i>我的潮购</a></li>
        </ul>
    </div>
</div>
</body>
@endsection
</html>
@section('my-js')
<script>
    function goClick(obj, href) {
        $(obj).empty();
        location.href = href;
    }
    if (navigator.userAgent.toLowerCase().match(/MicroMessenger/i) != "micromessenger") {
        $(".m-block-header").show();
    }
</script>
@endsection