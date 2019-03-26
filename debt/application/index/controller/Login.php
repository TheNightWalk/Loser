<?php
namespace app\index\controller;
use think\Controller;
use think\Request;

class Login extends Controller
{
    public function login(){
        return view();
    }

    public function logindo(){
        $user_name=input('post.user_name');
        $user_pwd=input('post.user_pwd');
        if(empty($user_name)){
            return $this->error('用户名不能为空！');
        }
        if(empty($user_pwd)){
            return $this->error('密码不能为空！');
        }
        $user_model=model('user');
        $where=[
          'user_name'=>$user_name,
        ];
        $user_data=$user_model->where($where)->find();
        if(empty($user_data)){
            return $this->error('用户名不存在！');
        }
        $pwd=md5(md5($user_pwd).json_encode($user_data['solt']));
        if($user_data['user_pwd']!=$pwd){
            return $this->error('密码错误！');
        }else{
            session('user',$user_data['user_name']);
            return $this->success('登录成功！',url('index/indexlist'));
        }
    }
}