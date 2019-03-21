<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\User;
use App\Model\Cart;

class ShopcartController extends Controller
{
    public function shopcart(Request $request)
    {
        if($request->session()->get('user')==''){
            return view('login');
        }
        $user_model=new User;
        $user_data=$user_model->where('user_tel',session('user'))->first();
        $user_id=$user_data['user_id'];
        $goods_model=new Goods;
        $cart_data=$goods_model->join('shop_cart',function($join){
            $join->on('shop_goods.goods_id','=','shop_cart.goods_id');
        })->where('user_id',$user_id)->get();
        $goods_data=$goods_model->where('is_hot',1)->limit(4)->get();
        return view('shopcart',['cart_data'=>$cart_data,'goods_data'=>$goods_data]);
    }

    public function shopcontent($id)
    {
        $goods_model=new Goods;
        $cart_model=new Cart;
        $goods_data=$goods_model->where('goods_id',$id)->first();
        if(empty($goods_data)){
            return back();
        }
        $goods_imgs=[];
        foreach(explode('|',$goods_data['goods_imgs']) as $v){
            if($v!=''){
                $goods_imgs[]=$v;
            }
        }
        $where=[
            'cart_status'=>1,
            'goods_id'=>$id,
        ];
        $cart_data=$cart_model->where($where)->get();
        $cart_num=0;
        foreach($cart_data as $v){
            $cart_num+=$v['buy_number'];
        }
        $goods_data['goods_imgs']=$goods_imgs;
        $num=$cart_num/$goods_data['goods_num'];
        $num=$num/100;
        return view('shopcontent',['data'=>$goods_data,'cart_num'=>$cart_num,'num'=>$num]);
    }
}