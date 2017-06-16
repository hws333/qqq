<?php
namespace Common\Model;

class CarModel extends \Think\Model\RelationModel
{
    protected  $_link=[
        'goods'=>[
            'mapping_type'=>self::BELONGS_TO,
            'foreign_key'=>'goods_id'
        ],
    ];
}