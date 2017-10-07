<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 14:33
 */
namespace app\admin\validate;
use think\Validate;

class Fuwu extends Validate{
    protected $rule=[
        ['name', 'require', '名字不能为空'],
        ['detail', 'require', '详细信息不能为空'],
        ['status', 'integer'],
        ['view', 'integer'],
    ];
}
