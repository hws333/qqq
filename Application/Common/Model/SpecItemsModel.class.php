<?php
namespace Common\Model;

class SpecItemsModel extends \Think\Model
{
   public $_link=[
       'spec' =>
			[
				'mapping_type'=>self::BELONGS_TO,
			],
        ];
}