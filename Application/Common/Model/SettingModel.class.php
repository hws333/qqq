<?php
namespace Common\Model;

class SettingModel extends \Think\Model
{

    protected $_validate=[
        ['company_name','require','公司名称不能为空'],
        ['company_name','0,30','商品名称长度不能超过30个字符',1,'length'],
        ['tel','require','电话不能为空'],
        ['tel','0,30','电话长度不能超过30个字符',1,'length'],
        ['fax','require','传真不能为空'],
        ['fax','0,30','传真长度不能超过30个字符',1,'length'],
        ['email','require','邮箱不能为空'],
        ['email','0,50','邮箱长度不能超过50个字符',1,'length'],
        ['email','email','请填写正确的邮箱',1],
        ['addre','require','地址不能为空'],
        ['web','require','网站不能为空',1],
        ['copyri','require','版权不能为空'],
        ['image','require','请上传二维码图片',1],
    ];

    public function setedit()
    {

        $set = M('Setting')->order('id')->limit(1)->find();
        

        $_POST['id']=$set['id'];
        // dump($set['id']);die;

        $res = $this->create();
        if ($res===false) {
            return $this->getError();
        }

        $row=$this->save();
        if (empty($row)) {
            return '修改失败';
        }

        return true;
    }
}