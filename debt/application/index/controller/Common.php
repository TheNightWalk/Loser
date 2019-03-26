<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct(Request $request = null)
    {
        if(empty(session('user'))){
            return $this->error('请登录',url('login/login'));
        }
        parent::__construct($request);
    }
}

