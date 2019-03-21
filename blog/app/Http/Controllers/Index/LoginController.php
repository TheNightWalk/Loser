<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logindo(Request $request)
    {
        $user_tel=$request->user_tel;
        $user_pwd=$request->user_pwd;
        $user_model=new User;
        $data=$user_model->where('user_tel',$user_tel)->first();
        if(empty($data)){
            echo 1;
        }else{
            $pwd=decrypt($data['user_pwd']);
            if($user_pwd==$pwd){
                $request->session()->put('user',$user_tel);
                echo 3;
            }else{
                echo 2;
            }
        }
    }

    public function register()
    {
        return view('register');
    }

    public function regauth()
    {
        $user_tel=session('data')['user_tel'];
        $start=substr($user_tel,0,3);
        $end=substr($user_tel,-4);
        $user_tel=$start.'******'.$end;
        return view('regauth',['user_tel'=>$user_tel]);
    }

    public function regauthdo(Request $request)
    {
        $code=rand(111111,999999);
        $user_tel=session('data')['user_tel'];
        $request->session()->put('code',$code);
        $captcha=LoginController::captcha($code,$user_tel);
    }

    private function captcha($code,$tel)
    {
        $host = "https://dxyzm.market.alicloudapi.com";
        $path = "/chuangxin/dxjk";
        $method = "POST";
        $appcode = "4ca982bb756148c2ac0f26cd2e0df6ab";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：{$code}，3分钟内有效！&mobile={$tel}";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }

    public function regauthdoes(Request $request){
        $code=$request->code;
        if($code!=session('code')){
            return 3;
        }
        $data=$request->session()->get('data');
        $user_tel=$data['user_tel'];
        $user_pwd=$data['user_pwd'];
        $user_model=new User;
        $user_model->user_tel=$user_tel;
        $user_model->user_pwd=$user_pwd;
        $res=$user_model->save();
        if($res){
            session(['code'=>null]);
            echo 1;
        }else{
            echo 2;
        }
    }

    public function registerdo(Request $request)
    {
        $user_tel=$request->user_tel;
        $user_pwd=$request->user_pwd;
        $validator = Validator::make($request->all(), [
            'user_tel' => 'required|digits:11|numeric|unique:shop_user',
            'user_pwd' => 'required'
        ],[
            'user_tel.required' => '请输入手机号',
            'user_tel.digits' => '手机号必须为11位的纯数字',
            'user_tel.numeric' => '手机号必须为11位的纯数字',
            'user_tel.unique' => '手机号已存在',
            'user_pwd.required' => '请输入密码',
        ]);
        if($validator->fails()){
            $error=$validator->errors()->getMessages();
            $errors=[];
            foreach($error as $k=>$v){
                $errors=$v[0];
            }
            return $errors;
        }else{
            $user_pwd=encrypt($user_pwd);
            $data=$request->all();
            $data['user_pwd']=$user_pwd;
            session(['data'=>$data]);
            if(!empty(session('data'))){
                return 1;
            }else{
                return 2;
            }
        }

    }
    public function findpwd()
    {
        return view('findpwd');
    }

    public function outlogin(Request $request)
    {
        $res=$request->session()->put('user',null);
        if(empty($res)){
            return redirect('/');
        }else{
            return back();
        }
    }
}