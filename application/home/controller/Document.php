<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/9/30
 * Time: 14:48
 */
namespace app\home\controller;
use think\Db;

class Document extends Home{
    //展示小区通知数据
    public function Survey(){
        $list=Db::name('document')->select();
        //var_dump($list);exit;
        $this->assign('list',$list);
        return $this->fetch('index');
    }

    //查看小区通知详情
    public function Details($id){
        //var_dump($id);exit;
        $info=Db::name('document')->find($id);
        //查询详情表的数据
        $row=Db::name('document_article')->find($id);
       // var_dump($row);exit;
        $this->assign('info',$info);
        $this->assign('row',$row);
        return $this->fetch();
    }
}