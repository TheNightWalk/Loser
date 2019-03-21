<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;
class IndexController extends Controller
{
    public function index()
    {
        $goods_model=new Goods;
        $goods_hot=$goods_model->where('is_hot',1)->limit(2)->get();
        $goods_data=$goods_model->get();
        $category_model=new Category;
        $categody_name=$category_model->where('pid',0)->get();
        return view('index',['goods_hot'=>$goods_hot,'goods_data'=>$goods_data,'category_name'=>$categody_name]);
    }

    public function willshare()
    {
        return view('willshare');
    }
}
