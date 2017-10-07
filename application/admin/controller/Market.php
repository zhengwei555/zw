<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/3
 * Time: 22:17
 */
namespace app\admin\controller;
use think\Db;
use think\Request;


class Market extends Admin{

        //显示列表
    public function index(){
        $list=Db::name('market')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add(){
       // var_dump(1);die;
        if(request()->isPost()){
            //实例化模型
            $market = model('market');
            //接收数据
            $post_data=\think\Request::instance()->post();
            //var_dump($post_data);exit;
            //自动验证
            $validate = validate('market');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            $post_data['create_time']=time();
            //var_dump($post_data);exit;
            //保存数据库
            $data = $market->insert($post_data);
            //判断是否添加成功
            if($data){
                $this->success('新增成功', url('index'));
            } else {
                $this->error($market->getError());
            }
        }
        $this->assign('info',null);
        return $this->fetch('add');
    }

    //修改
    public  function edit($id){
        if ($this->request->isPost()){
            $data=Request::instance()->post();
            //var_dump($data);exit;
            $market=Db::name('market');
            $data=$market->update($data);
            //判断是否成功
            if ($data){
                //成功返回信息 跳转到首页
                $this->success('修改成功',url('index'));
            }else{
                //失败显示错误信息
                $this->error('修改失败');

            }
        }
        //////////////回显
        $info=Db::name('market')->find($id);
        $this->assign('info',$info);
        return $this->fetch('add');
    }


    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('market')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}