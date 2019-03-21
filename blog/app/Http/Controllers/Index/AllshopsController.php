<?php
namespace app\Http\Controllers\Index;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class AllshopsController extends Controller
{
    public function allshops(Request $requset)
    {
        $category_model=new Category;
        $category_data=$category_model->get();
        $cate_id=$requset->category_id;
        $category_id=$this->cateInfoPid($category_data,$cate_id);
        $category_model=new Category;
        $category_name=$category_model->where('pid',0)->get();
        $goods_model=new Goods;
        $goods_data=$goods_model->whereIn('cate_id',$category_id)->get();
        return view('allshops',['category_name'=>$category_name,'goods_data'=>$goods_data,'cate_id'=>$cate_id]);
    }

    public function allshopsdo(Request $requset)
    {
        $goods_model=new Goods;
        $category_model=new Category;
        $category_data=$category_model->get();
        $type=$requset->type;
        $category_id=$requset->category_id;
        $content=$requset->content;
        $contents=$requset->contents;
        if(empty($content)){
            if($category_id==0){
                if(empty($type)){
                    $goods_data=$goods_model->get();
                }else if($type=='is_hot'){
                    $goods_data=$goods_model->where('is_hot',1)->get();
                }else if($type=='is_new'){
                    $goods_data=$goods_model->where('is_new',1)->get();
                }else{
                    $goods_data=$goods_model->orderBy('self_price',$type)->get();
                }
                return view('allshopsdo',['goods_data'=>$goods_data]);
            }else{
                $category_id=$this->cateInfoPid($category_data,$category_id);
                if(empty($type)){
                    $goods_data=$goods_model->whereIn('cate_id',$category_id)->get();
                }else if($type=='is_hot'){
                    $goods_data=$goods_model->whereIn('cate_id',$category_id)->where('is_hot',1)->get();
                }else if($type=='is_new'){
                    $goods_data=$goods_model->whereIn('cate_id',$category_id)->where('is_new',1)->get();
                }else{
                    $goods_data=$goods_model->whereIn('cate_id',$category_id)->orderBy('self_price',$type)->get();
                }
                return view('allshopsdo',['goods_data'=>$goods_data]);
            }
        }else{
            if(empty($type)){
                $goods_data=$goods_model->where('goods_name','like',"%$content%")->get();
            }else if($type=='is_hot'){
                $goods_data=$goods_model->where('goods_name','like',"%$content%")->where('is_hot',1)->get();
            }else if($type=='is_new'){
                $goods_data=$goods_model->where('goods_name','like',"%$content%")->where('is_new',1)->get();
            }else{
                $goods_data=$goods_model->where('goods_name','like',"%$content%")->orderBy('self_price',$type)->get();
            }
            
            return view('allshopsdo',['goods_data'=>$goods_data]);
        }
        
    }

    private function cateInfoPid($info,$pid){
        static $data=[];
        foreach($info as $v){
            if($v['pid']==$pid){
                $data[]=$v['cate_id'];
                $this->cateInfoPid($info,$v['cate_id']);
            }
        }
        return $data;
    }
}