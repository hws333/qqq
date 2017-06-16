<?php
namespace Common\Model;

class CustomerModel extends \Think\Model\RelationModel
{
    protected $_link=[
        'province'=>[
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Region',
            'foreign_key' => 'province'
        ],
        'city'=>[
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Region',
            'foreign_key' => 'city'
        ],
        'area'=>[
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Region',
            'foreign_key' => 'area'
        ],
    ];

    protected $_validate=[
        ['username','require','用户名不能为空'],
        ['username','username','该用户名已存在',1,'unique'],
        ['username','0,30','用户名称不能超过30个字符',1,'length'],
        ['password','require','密码不能为空'],
        ['enterpassword','require','请确认密码'],
        ['password','6,16','密码长度应在6~16位之间',1,'length'],
        ['password','enterpassword','密码不一致',1,'confirm'],
        ['email','require','邮箱不能为空'],
        ['email','email','邮箱格式不正确',1],
        ['tel','require','手机不能为空'],
        ['tel','/^1[34578]\d{9}$/','请输入正确的手机号码',1,'regex'],
        ['province','require','省份不能为空'],
        ['city','require','城市不能为空'],
        ['area','require','地区不能为空'],
        ['vcode','require','验证码不能为空'],
    ];

    protected $_auto=[
        ['password','md5',3,'function'],

    ];

    public function cus_register()
    {

        $vcode = new \Think\Verify();
        if(!$vcode->check(I('vcode'))){
			return '验证码不正确';
        }

        $res = $this->create();
        if($res===false){
            return $this->getError();
        }

        $id=$this->add();
        if(empty($id)){
            return '注册失败，请重试';
        }
        return true;
    }
}