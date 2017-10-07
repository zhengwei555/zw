<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/9/29
 * Time: 12:56
 */
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Request;

class  Repair extends Admin {
    public function index(){
        /* 获取频道列表 */
        $list = \think\Db::name('repair')->paginate(2);
        //var_dump($list);exit;

        $this->assign('list', $list);

        $this->assign('meta_title' , '事故报修');
        return $this->fetch();
    }

    //添加
    public function add(){
        if(request()->isPost()){
            //实例化模型
            $repair = model('repair');
            //接收数据
            $post_data=\think\Request::instance()->post();
            //var_dump($post_data);exit;
            //自动验证
            $validate = validate('repair');
            if(!$validate->check($post_data)){
                return $this->error($validate->getError());
            }
                $post_data['create_time']=time();
            //var_dump($post_data);exit;
            //保存数据库
            $data = $repair->insert($post_data);
            //判断是否添加成功
            if($data){
                $this->success('新增成功', url('index'));
            } else {
                $this->error($repair->getError());
            }
        }
            $this->assign('info',null);
            $this->assign('meta_title', '新增事故');
            return $this->fetch('edit');
        }

        //修改
    public function edit($id)
    {
        if ($this->request->isPost()) {
            $repair = \think\Request::instance()->post();
            $Channel = \think\Db::name("repair");
            $data = $Channel->update($repair);
            if ($data !== false) {
                $this->success('编辑成功', url('index'));
            } else {
                $this->error('编辑失败');
            }
        } else {
            $info = array();
            /* 获取数据 */
            //回显数据
            $info = \think\Db::name('repair')->find($id);

            if (false === $info) {
                $this->error('获取配置信息错误');
            }

            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            return $this->fetch();
        }

    }

//
    //删除
    public function del(){
        $id = array_unique((array)input('id/a',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(\think\Db::name('repair')->where($map)->delete()){
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

//    public function index(){
//        $list=Db::name('repair')->select();
//        $this->assign('list',$list);
//        return $this->fetch('index');
//    }
//
//    public function add(){
//        //判断是否是POst提交
//        if($this->request->isPost()){
//            //实例化模型
//            $repair=model('repair');
//            //接收数据
//            $data=Request::instance()->post();
//            //var_dump($data);exit;
//            //验证数据
//            $validate=validate('repair');
//            if (!$validate->check($data)){
//                //验证不通过 返回错误信息
//                return $this->error($validate->getError());
//            }
//            $data['create_time']=time();
//            //保存到数据库
//            $data=$repair->insert($data);
//            //判断是否添加成功
//            if($data){
//                //成功提示信息 并返回首页
//                $this->success('添加成功',url('index'));
//            }else{
//                //失败返回错误信息
//                $this->success($repair->getError());
//            }
//        }
//        //显示视图
//        return $this->fetch('edit');
//    }
//
//    //修改
//    public function edit($id){
//        if($this->request->isPost()){
//            //接收数据
//            $data=Request::instance()->post();
//            $repair=Db::name('repair');
//            $data=$repair->update($data);
//            //判断是否成功
//            if ($data){
//                //成功返回信息 跳转到首页
//                $this->success('修改成功',url('index'));
//            }else{
//                //失败显示错误信息
//                $this->error('修改失败');
//
//            }
//        }
//            //回显数据
//            $info=Db::name('repair')->find($id);
//            //分配数据
//            $this->assign('info',$info);
//            return $this->fetch('edit');
//
//    }
 }