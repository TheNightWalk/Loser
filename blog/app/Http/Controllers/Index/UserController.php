<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\User;

class UserController extends Controller
{
    public function mywallet()
    {
        return view('mywallet');
    }

    public function set()
    {
        return view('set');
    }

    public function safeset()
    {
        return view('safeset');
    }

    public function invite()
    {
        return view('invite');
    }

    public function address()
    {
        return view('address');
    }

    public function edituser()
    {
        $user_model=new User;
        $user_data=$user_model->where('user_tel',session('user'))->first();
        return view('edituser',['user_data'=>$user_data]);
    }
}