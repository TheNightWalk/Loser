<?php
namespace app\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user');
    }

    public function indexdo(Request $request)
    {
        $data=$request->all();
        unset($data['_token']);
        if(empty($data['user_name'])){
            echo "<script>var one=confirm('用户名不能为空!')
                if(one){
                    location.href='user';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='user';
                }
            </script>";exit;
        }
        if(empty($data['user_pwd'])){
            echo "<script>var one=confirm('密码不能为空!')
                if(one){
                    location.href='user';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='user';
                }
            </script>";exit;
        }
        $user_model=new User;
        $user_name=$user_model->where('user_name',$data['user_name'])->first();
        if(!empty($user_name)){
            echo "<script>var one=confirm('用户名已存在!')
                if(one){
                    location.href='user';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='user';
                }
            </script>";exit;
        }
        $res=$user_model->insert($data);
        if($res){
            echo "<script>alert('注册成功');location.href='login';</script>";
        }else{
            echo "<script>alert('注册失败');location.href='user';</script>";
        }
    }

    public function login(){
        return view('login');
    }

    public function logindo(Request $request){
        $user_name=$request->user_name;
        $user_pwd=$request->user_pwd;
        if(empty($user_name)){
            echo "<script>var one=confirm('用户名不能为空!')
                if(one){
                    location.href='login';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='login';
                }
            </script>";exit;
        }
        if(empty($user_pwd)){
            echo "<script>var one=confirm('密码不能为空!')
                if(one){
                    location.href='login';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='login';
                }
            </script>";exit;
        }
        $user_model=new User;
        $res=$user_model->where('user_name',$user_name)->first();
        if(empty($res)){
            echo "<script>var one=confirm('用户名不存在!')
                if(one){
                    location.href='login';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='login';
                }
            </script>";exit;
        }else if($res['user_pwd']!=$user_pwd){
            echo "<script>var one=confirm('密码不正确!')
                if(one){
                    location.href='login';
                }else{
                    alert('不确定也必须确定！！');
                    location.href='login';
                }
            </script>";exit;
        }else{
            $request->session()->put('admin', $user_name);
            return redirect(url('index/indexdoes'));
        }
    }

    public function pwdedit($id){
        $user_name=$id;
        return view('pwdedit',['user_name'=>$user_name]);
    }

    public function pwdeditdo(Request $request){
        $user_pwd=$request->user_pwd;
        $user_model=new User;
        $user_name=$request->session()->get('admin');
        $user_model->where('user_name',$user_name)->update(['user_pwd'=>$user_pwd]);
        if($user_model){
            return redirect(url('index/indexdoes'));
        }else{
            return redirect(url("index/indexdoes\\$user_name"));
        }
    }
}