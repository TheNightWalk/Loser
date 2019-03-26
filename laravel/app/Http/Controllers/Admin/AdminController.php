<?php
namespace app\Http\Controllers\Admin;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if(empty($request->session()->get('admin'))){
            echo "<script>alert('请登录')</script>";exit;
        }
        $data=DB::table('type')->get();
        return view('hello',['data'=>$data]);
    }

    public function indexdo(Request $request)
    {
        $time=date('Y.m.d',time());
        $filename=uniqid().'.tmp';
        $file=$request->cover->move("uploads/$time",$filename);
        if($file){
            $src=$time.'/'.$filename;
            $data=$request->all();
            $data['cover']=$src;
            unset($data['_token']);
            $res=DB::table('admin')->insert($data);
            if($res){
                return redirect('index/indexdoes');
            }else{
                return redirect('index/index');
            }
        }
    }

    public function indexdoes(Request $request)
    {
        $data=DB::table('admin')->get();
        if($request->session()->get('admin')!=null){
            $unsalute=DB::table('unsalute')->count();
            if(!empty($unsalute)){
                $unsalute=DB::table('unsalute')->where('user_name',$request->session()->get('admin'))->get();
            }
            $salute=DB::table('salute')->count();
            if(!empty($salute)){
                $salute=DB::table('salute')->where('user_name',$request->session()->get('admin'))->get();
            }
            $audit=DB::table('audit')->count();
        }else{
            $unsalute='';
            $salute='';
        }
        return view('list',['data'=>$data,'salute'=>$salute,'unsalute'=>$unsalute,'num'=>$audit]);
    }

    public function salute(Request $request){
        $where=$request->all();
        $where['user_name']=$request->session()->get('admin');
        $salute=DB::table('salute')->where($where)->count();
        if(!empty($salute)){
            DB::table('salute')->where($where)->delete();
        }else{
            DB::table('salute')->insert($where);
        }
    }

    public function unsalute(Request $request){
        $where=$request->all();
        $where['user_name']=$request->session()->get('admin');
        $salute=DB::table('unsalute')->where($where)->count();
        if(!empty($salute)){
            DB::table('unsalute')->where($where)->delete();
        }else{
            DB::table('unsalute')->insert($where);
        }
    }

    public function lists(Request $request,$id)
    {
        $data=DB::table('admin')->find($id);
        $count=DB::table('comment')->count();
        if(!empty($count)){
            $comment=DB::table('comment')->where('id',$id)->orderBy('comment_id','desc')-> take(3)->get();
        }else{
            $comment='';
        }
        return view('lists',['data'=>$data,'comment'=>$comment]);
    }

    public function listsdo(Request $request)
    {
        $data=$request->all();
        $content=$request->comment_content;
        $id=$request->id;
        $user_name=$request->user_name;
        if($user_name==$request->session()->get('admin')){
            unset($data['admin_name']);
            $res=DB::table('comment')->insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $res=DB::table('audit')->insert($data);
            if($res){
                echo 3;
            }else{
                echo 2;
            }
        }
    }

    public function audit(Request $request)
    {
        $data=DB::table('audit')->where('audit_name',$request->session()->get('admin'))->get();
        return view('audit',['data'=>$data]);
    }

    public function auditdo(Request $request)
    {
        $data=$request->all();
        $type=$request->type;
        if($type=='通过'){
            DB::table('audit')->where('audit_id',$data['audit_id'])->delete();
            unset($data['type']);
            unset($data['audit_id']);
            $res=DB::table('comment')->insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }else{
            $res=DB::table('audit')->where('audit_id',$data['audit_id'])->delete();
            if($res){
                echo 3;
            }else{
                echo 2;
            }
        }
    }
}