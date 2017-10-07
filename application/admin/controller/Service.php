<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/2
 * Time: 22:06
 */
namespace  app\admin\controller;
use think\Db;
use think\Request;

class Service extends  Admin{
    //列表
    public function Index(){
        $list=Db::name('service')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加
    public function add(){
        if($this->request->isPost()){
            $service=model('service');
            //接收数据
            $data=Request::instance()->post();
            //var_dump($data);exit;
            //验证数据
            $validate=validate('service');
            if(!$validate->check($data)){
                //验证不通过返回错误信息
                return $this->error($service->getError());
            }
            //保存到数据库
            //var_dump(111);exit;
            $data['create_time']=time();
            $data=$service->insert($data);
            //判断是否添加成功
            if($data){
                //成功
                $this->success('添加成功',url('index'));
            }else{
                //失败返回错误信息
                $this->error($service->getError());
            }
        }
        return $this->fetch();
    }

    //编辑
    public function edit($id){
        if ($this->request->isPost()){
            $data=Request::instance()->post();
            //var_dump($data);exit;
            $service=Db::name('service');
            $data=$service->update($data);
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
        $info=Db::name('service')->find($id);
        //var_dump($info);exit;
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
        if(\think\Db::name('service')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

}