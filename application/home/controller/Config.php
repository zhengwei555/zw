<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/4
 * Time: 10:13
 */
namespace app\home\controller;
use think\Db;

class Config extends Home{
    //显示关于我们的页面
    public function index(){
        $list=Db::name('config')->where(['id'=>2])->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
        return $this->fetch();
    }
}