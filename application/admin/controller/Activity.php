<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/1
 * Time: 17:38
 */
namespace  app\admin\controller;
use think\Db;
use think\Request;

class Activity extends Admin{
    //显示列表
    public function index(){
        $list=Db::name('activity')->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加
    public function add(){
        if($this->request->isPost()){
            $activity=model('activity');
            //接收数据
            $data=Request::instance()->post();
            //var_dump($data);exit;
            //验证数据
            $validate=validate('activity');
            //
            if(!$validate->check($data)){
                //验证不通过返回错误信息
                return $this->error($activity->getError());
            }
            //保存到数据库
            //var_dump(111);exit;
            $data=$activity->insert($data);
            //判断是否添加成功
            if($data){
                //成功
                 $this->success('添加成功',url('index'));
            }else{
                //失败返回错误信息
                $this->success($activity->getError());
            }
        }
        //显示视图
        return $this->fetch();
    }

    //修改
    public function edit($id){
        if($this->request->isPost()){
            //接收数据
            $data=Request::instance()->post();
            $activity=Db::name('activity');
            $data=$activity->update($data);
            //判断是否成功
            if ($data){
                //成功返回信息 跳转到首页
                $this->success('修改成功',url('index'));
            }else{
                //失败显示错误信息
                $this->error('修改失败');

            }
        }
        /////////////回显
        //根据ID查出数据
        $info=Db::name('activity')->find($id);
        //分配数据
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
        if(\think\Db::name('activity')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

 }