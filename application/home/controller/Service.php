<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/4
 * Time: 10:26
 */
namespace app\home\controller;
use think\Db;

class Service extends Home{
    //显示列表
    public function index(){
        $list=Db::name('service')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //显示详情
    public  function lists($id){
        $list=Db::name('service')->find($id);
        //var_dump($list);exit;
        $this->assign('list',$list);
        return $this->fetch();
    }
}