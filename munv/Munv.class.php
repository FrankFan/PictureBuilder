<?php  

/**
 * 制作图片“妈妈再打我一次”的类
 */

class Munv{
	//参数变量
	private $text1 = ''; //文字1
	private $text2 = ''; //文字2
	private $text3 = ''; //文字3
	
	/* 写php赚钱，因为php中到处都是$  :) */

	private $img; //画布

	private $font_file = '../images/msyhbd.ttf'; //微软雅黑粗体字体文件

	/**
	 * 生成图片的方法
	 */
	public function generate(){
		//1.初始化请求数据
		$this->initText();

		//2.创建图片画布
		$this->mkImg();
		
		//3.将文字打印到图片的固定位置
		$this->addText();
		
		//4.返回图片内容
		$this->outputImg();
		//5.释放画布资源
		$this->destroyImg();
	}

	/**
	 * 初始化参数
	 */
	private function initText(){
		$this->text1 = $_REQUEST['text1'];
		$this->text2 = $_REQUEST['text2'];
		$this->text3 = $_REQUEST['text3'];
	}

	/**
	 * 创建画布
	 */
  	private function mkImg(){
  		$img_file = '../images/munv.jpg';
  		$this->img = imagecreatefromjpeg($img_file); //通过jpeg格式图片创建画布
  	}

  	/**
  	 * 给图片添加文字
  	 */
  	private function addText(){
  		//使用imagefttext()方法添加文字
  		//imagefttext( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text)
  		//imagefttext(画布,字体大小,书写方向,文字基准位置x,文字基准位置y,颜色,字体文件,文本内容)
  		//颜色处理必须使用RGB形式表示
  		//颜色首先要分配到图片画布上，才能在画布上使用，利用函数imagecolorallocate来分配
  		//字体文件，采用微软雅黑粗体字体 msyhbd.ttf

  		//颜色
		$text1_color = imagecolorallocate($this->img, 63, 72, 204);
		$text2_color = imagecolorallocate($this->img, 63, 72, 204);
		$text3_color = imagecolorallocate($this->img, 63, 72, 204);


		//文字1
		imagefttext($this->img, 16, 0, 50, 186, $text1_color, $this->font_file, $this->text1);

		//文字2
		imagefttext($this->img, 16, 0, 50, 366, $text2_color, $this->font_file, $this->text2);

		//文字3
		imagefttext($this->img, 16, 0, 50, 560, $text3_color, $this->font_file, $this->text3);
  	}

  	/**
  	 * 输出图片到浏览器进行展示
  	 */
  	private function outputImg(){
      //告诉浏览器已jpeg图片形式显示&不要缓存		
  		header('Content-Type: image/jpeg');  		
  		header('Cache-control: no-chace');

  		//利用函数 imagejpeg() 将图片已jpeg格式进行输出
  		imagejpeg($this->img);
  	}

  	/**
  	 * 释放图片资源
  	 */
  	private function destroyImg(){
      //销毁图片
  		imagedestroy($this->img);
  	}

}
?>
