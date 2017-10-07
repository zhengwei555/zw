<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/3
 * Time: 11:18
 */
namespace  app\admin\controller;
use think\Db;
use think\Request;

class Rental extends  Admin{
    //添加
    public function index(){
       $list=Db::name('rental')->select();
       //var_dump($list);exit;
       $this->assign('list',$list);
       return $this->fetch();
    }
    //添加
    public function add(){
        if(request()->isPost()){
            //实例化模型
            $rental = model('rental');
            //接收数据
            $post_data=\think\Request::instance()->post();
            //var_dump($post_data);exit;
            //自动验证
            $validate = validate('rental');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
            $post_data['create_time']=time();
            //var_dump($post_data);exit;
            //保存数据库
            $data = $rental->insert($post_data);
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
    public function edit($id){
        if ($this->request->isPost()){
            $data=Request::instance()->post();
            //var_dump($data);exit;
            $rental=Db::name('rental');
            $data=$rental->update($data);
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
        $info=Db::name('rental')->find($id);
        $this->assign('info',$info);
        return $this->fetch('add');
    }

    //删除
    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('rental')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}