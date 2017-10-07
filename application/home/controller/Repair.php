<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/9/30
 * Time: 11:24
 */
namespace app\home\controller;
use app\admin\controller\Admin;
use think\Request;

class Repair extends Home {
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
                $this->success('报修成功', url('index'));
            } else {
                $this->error($repair->getError());
            }
        }
        $this->assign('info',null);
        $this->assign('meta_title', '新增事故');
        return $this->fetch('add');
    }
}