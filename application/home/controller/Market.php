<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/4
 * Time: 22:00
 */
namespace app\home\controller;
use think\Db;

class Market extends Home{
    //显示列表
    public function index(){
        $list=Db::name('market')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    //详情
    public function details($id){
        $list=Db::name('market')->find($id);
        $this->assign('list',$list);
        return $this->fetch('lists');
    }
}