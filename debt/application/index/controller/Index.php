<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        return $this->fetch();
    }

    public function indexdo()
    {
        $data=input('post.');
        if(empty($data['username'])){
            return $this->error('欠款人不能为空！');
        }
        if(empty($data['money'])){
            return $this->error('金额不能为空！');
        }
        $index_model=model('index');
        $where=[
            'username'=>$data['username']
        ];
        $res=$index_model->where($where)->count();
        if(empty($res)){
            $res=$index_model->save($data);
            if($res){
                return $this->success('添加成功！',url('index/indexlist'));
            }else{
                return $this->success('添加失败！');
            }
        }else{
            $update=[
                'money'=>$res['money']+$data['money']
            ];
            $res=$index_model->save($update,$where);
            if($res){
                return $this->success('添加成功！',url('index/indexlist'));
            }else{
                return $this->error('添加失败！');
            }
        }
    }

    public function indexlist()
    {
        $index_model=model('index');
        $p=input('get.p');
        $data=$index_model->where('stutas','0')->paginate(3, false, ['var_page'=>'p']);

        if(empty($data)){
            return $this->success('还没人欠款呢！');
        }else{
            $data_money=$index_model->where('stutas','0')->select();
            $money=0;
            foreach ($data_money as $v){
                $money+=$v['money'];
            };
            $this->assign('money',$money);
            $this->assign('page',$data);
            return $this->fetch();
        }
    }

    public function indexdel(){
        $id=input('get.id');
        $index_model=model('index');
        $where=[
            'id'=>$id
        ];
        $update=[
            'stutas'=>'1'
        ];
        $res=$index_model->save($update,$where);
        if($res){
            return $this->success('删除成功！');
        }else{
            return $this->error('删除失败');
        }
    }

    public function indexedit(){
        $id=input('get.id');
        $index_model=model('index');
        $data=$index_model->where('id',$id)->find();
        $this->assign('data',$data);
        return $this->fetch();
    }

    public function indexeditdo(){
        $data=input('post.');
        if(empty($data['money'])){
            return $this->error('金额不能为空！');
        }
        $index_model=model('index');
        $money=$index_model->where('username',$data['username'])->find();
        if($money['money']==$data){
            return $this->success('修改成功！');
        }
        $where=[
            'username'=>$data['username']
        ];
        $res=$index_model->save($data,$where);
        if($res){
            return $this->success('修改成功！',url('index/indexlist'));
        }else{
            return $this->error('修改失败！');
        }
    }
}
