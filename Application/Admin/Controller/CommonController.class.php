<?php
namespace Admin\Controller;

class CommonController extends BaseController {
	public function uploadify($filename='img'){
//           $config=[
//               'maxSize' => 2*1024*1024,
//               'exts' => ['jpg','gif','jpeg','png','bmp'],
//               'rootPath' => './Public/Upload/',
//               'saveName'=> time().mt_rand(0,100000),
//           ];

//           //图片上传
           $upload = new \Think\Upload();
           $upload->maxSize =2*1024*1024;
           $upload->exts = ['jpg','gif','jpeg','png','bmp'];
           $upload->rootPath = 'Public/Upload/';
           $upload->saveName = time().mt_rand(0,100000);

           //判断路径是否存在，不存在则自动创建
           if(!is_dir($upload->rootPath)){
               mkdir($upload->rootPath);
           }

           $img = $upload->uploadOne($_FILES[$filename]);
//           print_r($img);return;

           // 上传错误提示错误信息
           if(!$upload) {
               die(json_encode([
                   'error'=>1,
                   'meg'=>$upload->getError()
               ]));
           }

           $path =  $upload->rootPath . $img['savepath']. $img['savename'];
           die(json_encode([
               'error'=>0,
               'path'=>$path
           ]));

       }
}