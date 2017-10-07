<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/5
 * Time: 10:32
 */
namespace app\home\controller;
use think\Db;

class Life extends Home{
    //显示列表
    public function index(){
        $list=Db::name('life')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //详情
    public function details($id){
        $list=Db::name('life')->find($id);
        //var_dump($list);exit;
        $this->assign('list',$list);
        return $this->fetch('lists');
    }
}