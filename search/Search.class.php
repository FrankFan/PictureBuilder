<?php  

/**
 * 制作图片“搜索引擎结果恶搞图片”的类
 */

class Search{
	//参数变量
	private $img_typeId = 0; //图片类别Id,0 baidu, 1 google
	private $text1 = ''; //文字1：输入文字
	private $text2 = ''; //文字2：输出文字
	
	/* 写php赚钱，因为php中到处都是$  :) */

	private $img; //画布

	//private $fontbd_file = '../images/msyhbd.ttf'; //微软雅黑粗体字体文件
	private $font_file = '../images/msyh.ttf'; //微软雅黑字体文件

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
		$this->img_typeId = $_REQUEST['img_typeId'];
		$this->text1 = $_REQUEST['text1'];
		$this->text2 = $_REQUEST['text2'];

	}

	/**
	 * 创建画布
	 */
  	private function mkImg(){
  		$img_file = '../images/'.'search_'.$this->img_typeId.'.'.'jpg';
  		
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
  		//字体文件，采用微软雅黑字体 msyh.ttf

  		switch ($this->img_typeId) {
  			case 1: //百度图片
  				//颜色
  				$text1_color = imagecolorallocate($this->img, 0, 0, 0);
  				$text2_color = imagecolorallocate($this->img, 213, 0, 0);

  				//文字1
  				imagefttext($this->img, 12, 0, 24, 74, $text1_color, $this->font_file, $this->text1);

  				//文字2
  				imagefttext($this->img, 11, 0, 145, 120, $text2_color, $this->font_file, $this->text2);

  				break;
  			
  			case 2: //google图片
  				//颜色
  				$text1_color = imagecolorallocate($this->img, 0, 0, 0);
  				$text2_color = imagecolorallocate($this->img, 213, 0, 0);

  				//文字1
  				imagefttext($this->img, 12, 0, 129, 39, $text1_color, $this->font_file, $this->text1);

  				//文字2
  				imagefttext($this->img, 12, 0, 357, 175, $text2_color, $this->font_file, $this->text2);
  				break;

  			default:
  				# code...
  				break;
  		}
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
