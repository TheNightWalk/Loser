<?php
namespace app\Http\Controllers\Test;
use Illuminate\Routing\Controller;
use App\Model\TestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Test;

class TestController extends Controller
{
    public function test()
    {
        return view('test');
    }

    public function testdo(Request $request)
    {
        $data=$request->all();
        $file=$request->file('catenate_Logo');
        $src=uniqid().time().'.tmp';
        $path='./uploads/'.date('Ymd',time());
        $validate = Validator::make($data,[
            'catenate_name' => 'required|unique:catenate|max:255',
            'catenate_URL' => 'required|URL',
            'catenate_tel' => 'required|digits:11|numeric',
        ],[
            'catenate_name.required'    => '网址名称不能为空',
            'catenate_name.unique'    => '网址名称已存在',
            'catenate_name.required'    => '网址名称最大值为255',
            'catenate_URL.required'    => '网址URL不能为空',
            'catenate_URL.URL'    => '请输入正确的URL格式',
            'catenate_tel.required'    => '电话不能为空',
            'catenate_tel.digits' => '电话必须为11位的纯数字',
            'catenate_tel.numeric' => '电话必须为11位的纯数字',
        ] );
        if($validate->fails()){
            $error=$validate->errors()->getMessages();
            $errors=[];
            foreach($error as $k=>$v){
                $errors[]=$v[0];
            }
            echo $errors[0].',请返回重试';
        }else{
            $file_res=$file->move($path,$src);
            if($file_res){
                $test_model=new TestModel;
                $data['catenate_Logo']=date('Ymd',time()).'/'.$src;
                unset($data['_token']);
                $res_model=$test_model->insert($data);
                if($res_model){
                    return redirect('test/list');
                }else{
                    echo '添加过程中遇到未知错误，请返回后重试';
                }
            }else{
                echo '文件上传失败，请返回重试';
            }
        }
    }

    public function lists()
    {
        $test_model=new TestModel;
        $data=$test_model->simplePaginate(2);
        return view('testlists',['data'=>$data]);
    }

    public function del(Request $request)
    {
        $id=$request->catenate_id;
        $test_model=new TestModel;
        $res=$test_model->where('catenate_id',$id)->delete();
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function search(Request $request)
    {
        $content=$request->content;
        $test_model=new TestModel;
        $data=$test_model->where('catenate_name','like',"%$content%")->simplePaginate(2);
        return view('search',['data'=>$data]);
    }
}