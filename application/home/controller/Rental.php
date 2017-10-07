<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/10/4
 * Time: 21:26
 */
namespace app\home\controller;
use think\Db;

class Rental extends Home{
    //显示列表
    public function index(){
        $list=Db::name('rental')->where(['type'=>2])->select();
        $rows=Db::name('rental')->where(['type'=>1])->select();
        $this->assign('list',$list);
        $this->assign('rows',$rows);
        return $this->fetch();

    }

    //详情
    public function lists($id){
        $list=Db::name('rental')->find($id);
        $this->assign('list',$list);
        return $this->fetch();
    }
}