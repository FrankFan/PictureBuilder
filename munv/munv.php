<?php 

/**
 * 使用php操作GD库，完成图片生成
 */

//用面向对象的方式编程，引入类定义文件
require 'Munv.class.php';
$pic = new Munv; //实例化对象
$pic->generate(); //调用生成图片的方法

?>