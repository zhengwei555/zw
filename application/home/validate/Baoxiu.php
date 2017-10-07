<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 14:33
 */
namespace app\admin\validate;
use think\Validate;

class Baoxiu extends Validate{
    protected $rule=[
        ['sn', 'require', '标号不能为空'],
        ['name', 'require', '名字不能为空'],
        ['tel', 'require', '电话不能为空'],
        ['detail', 'require', '详细信息不能为空'],
        ['area', 'require', '地址不能为空'],
        ['status', 'integer'],
    ];
}
