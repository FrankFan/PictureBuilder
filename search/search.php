<?php 

/**
 * 使用php操作GD库，完成图片生成
 */


//用面向对象的方式编程，引入类定义文件
require 'Search.class.php';


$pic = new Search; //实例化对象

//print_r($pic);
//print_r($_REQUEST); die();
$pic->generate(); //调用生成图片的方法




?>