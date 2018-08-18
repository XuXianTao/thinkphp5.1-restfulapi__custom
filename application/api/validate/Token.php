<?php
namespace app\api\validate;

use think\Validate;
/**
 * 生成token参数验证器
 */
class Token extends Validate
{

	protected $rule = [
        'appid'       =>  'require',
        'carid'      =>  'require',
        'nonce'       =>  'require',
        'timestamp'   =>  'number|require',
        'sign'        =>  'require'
    ];

    protected $message  =   [
        'appid.require'    => 'appid不能为空',
        'carid.require'    => '车牌号carid不能为空',
        'nonce.require'    => '随机数nonce不能为空',
        'timestamp.number' => '时间戳timestamp格式错误',
        'sign.require'     => '签名sign不能为空',
    ];
}
