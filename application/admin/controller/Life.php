<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/5
 * Time: 10:15
 */
namespace app\admin\controller;
use think\Db;
use think\Request;

class Life extends Admin{
    //显示列表
    public function index(){
        $list=Db::name('life')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //添加
    public  function add(){
        if($this->request->isPost()){
            $life=model('life');
            //接收数据
            $data=Request::instance()->post();
            //var_dump($data);exit;
            //验证数据
            $validate=validate('life');
            //
            if(!$validate->check($data)){
                //验证不通过返回错误信息
                return $this->error($life->getError());
            }
            //保存到数据库
            //var_dump(111);exit;
            $data=$life->insert($data);
            //判断是否添加成功
            if($data){
                //成功
                $this->success('添加成功',url('index'));
            }else{
                //失败返回错误信息
                $this->success($life->getError());
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
            $life=Db::name('life');
            $data=$life->update($data);
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
        $info=Db::name('life')->find($id);
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
        if(\think\Db::name('life')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}