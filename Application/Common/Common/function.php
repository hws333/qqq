<?php
//1、
//array(
//  child=>array(
//      child=>array(
//          )
//      )
//  )
//function ctree($cateArr,$pid=0)
//{
//    $data = [];
//    foreach ($cateArr as $k => $v) {
//        if ($v['pid'] == $pid) {
//            $v['child']=ctree($cateArr,$v['id']);
//            $data[] = $v;
//            unset($cateArr[$k]);
//        }
//    }
//    return $data;
//}
//
//无极分类 传值引用
//      $refer = [];
//      $tree = [];
//      foreach($catedata as $k => $v){
//          $refer[$v['id']] = & $catedata[$k];
//      }
//      echo '<pre>';
//      print_r($refer);
//      echo '</pre>';
//      echo '<hr />';
//      foreach($catedata as $k => $v){
//          if($v['pid'] == 0){
//              $tree[] = & $refer[$v['id']];
//          }
//          else{
//              $parent = & $refer[$v['pid']];
//              dump($parent);echo '<br />';
//              $parent['child'][] = & $refer[$v['id']];
//              dump($parent);echo '<hr />';
//          }
//      }

/*
 * 关联删除
*/
function relation_del($tablename,$map){
    $find=M($tablename)->where($map)->find();
    if(!empty($find)){
        $row=M($tablename)->where($map)->delete();
        if(empty($row)){
            $this->rollback();
            return '删除失败';
        }
    }
}



/*
 * 获取数组的排列组合
*/
function get_array_group($arr){
    $group=[];
    foreach($arr as $v){
        if(empty($group)){
            foreach ($v as $value) {
                $group[]=[$value];
            }
        }else{
            $tmp=[];
//                   $group=$this->getGroup($group,$v);
            foreach ($group as $val){
                foreach($v as $g){
                    if(!is_array($val)){
                        $tmp[]=[$val,$g];
                    }else{
                        $val[]=$g;
                        $tmp[]=$val;
                        array_pop($val);
                    }
                }
            }
            $group= $tmp;
        }
    }
    return $group;
}


/*
 * 无极分类
*/
function cate_tree($cateArr,$pid=0,$level=1){
    //查找顶级分类
    $data=[];
    foreach($cateArr as $k => $v){
        if($v['pid']==$pid){
            $v['level']=$level;
            $data[]=$v;

            unset($cateArr[$k]);

            //查找当前id的子级分类
            $temp = cate_tree($cateArr,$v['id'],$level+1);
            if(!empty($temp)){
                $data=array_merge($data,$temp);
            }

        }
    }
    return  $data;
}

