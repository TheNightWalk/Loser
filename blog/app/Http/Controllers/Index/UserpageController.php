<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\User;

class UserpageController extends Controller
{
    public function userpage()
    {
        if(empty(session('user'))){
            return view('userpageunlogin');
        }
        $user_model=new User;
        $user_data=$user_model->where('user_tel',session('user'))->first();
        $start=substr(strtotime($user_data['created_at']),0,4);
        $end=substr(strtotime($user_data['created_at']),-2);
        $id=$start.$user_data['user_id'].$end;
        return view('userpage',['user_data'=>$user_data,'id'=>$id]);
    }
}