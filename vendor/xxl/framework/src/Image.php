<?php

namespace vendor;

class Image
{
	//保存路径
	protected $path;
	//图片要保存的格式
	protected $type;
	//是否启用随机的名字
	protected $isRandName;
	
	function __construct($path = './upload/', $type = 'png', $isRandName = true)
	{
		$this->path = $path;
		$this->type = $type;
		$this->isRandName = $isRandName;
	}
	
	//水印方法
	function water($waterPath, $dstPath, $position = 9, $tmd = 50, $prefix = 'wa_')
	{
		//判断两个图片有没有
		if (!file_exists($waterPath) || !file_exists($dstPath)) {
			die('哥们，没图片怎么撸代码');
		}
		
		//判断水印图片的大小是否小于目标图片
		$waterInfo = self::getImageInfo($waterPath);
		$dstInfo = self::getImageInfo($dstPath);
		if ($waterInfo['width'] > $dstInfo['width'] || $waterInfo['height'] > $dstInfo['height']) {
			die('水印图片太大，看不见目标图片，如何撸代码');
		}
		
		//打开图片开始  不同的图片要使用不同的函数进行打开
		$waterRes = self::openAnyImage($waterPath);
		$dstRes = self::openAnyImage($dstPath);
		
		//计算位置
		if ($position) {
			$w = ($dstInfo['width'] - $waterInfo['width']) / 2;
			$h = ($dstInfo['height'] - $waterInfo['height']) / 2;
			//计算行号和列号
			$row = floor(($position - 1) / 3);
			$col = ($position - 1) % 3;
			$x = $w * $col;
			$y = $h * $row;
		} else {
			$x = mt_rand(0, ($dstInfo['width'] - $waterInfo['width']));
			$y = mt_rand(0, ($dstInfo['height'] - $waterInfo['height']));
		}
		
		//将水印图片给贴过去
		imagecopymerge($dstRes, $waterRes, $x, $y, 0, 0, $waterInfo['width'], $waterInfo['height'], $tmd);
		
		//生成新的文件名
		$newName = $this->createNewName($prefix, $dstPath);
		$filePath = rtrim($this->path, '/') . '/' . $newName;
		//保存图片  你要保存成png 格式的图片，那么你就要使用imagepng这个函数保存,如果你要保存成gif格式的图片，那么你就要使用imagegif这个函数保存
		//将其拼接成一个变量函数
		$func = 'image' . $this->type;
		$func($dstRes, $filePath);
		//释放资源
		imagedestroy($waterRes);
		imagedestroy($dstRes);
	}
	
	public function suofang($imagePath, $width, $height, $prefix)
	{
		//判断图片是否存在
		if (!file_exists($imagePath)) {
			die('哥们，图片不存在，如何放大图片撸代码');
		}
		
		//获取图片的信息
		$imageInfo = self::getImageInfo($imagePath);
		//根据图片原来的宽高和要缩放的宽高计算缩放之后的宽高以及位置
		$size = $this->getNewSize($width, $height, $imageInfo);
		
		//打开图片资源
		$imageRes = self::openAnyImage($imagePath);
		//处理透明色的问题,得到新的缩放后的图像资源
		$newRes = $this->KidOfImage($imageRes, $size, $imageInfo);
		
		//得到新的文件名
		$newName = $this->createNewName($prefix, $imagePath);
		//得到新的文件全路径
		$filePath = rtrim($this->path, '/') . '/' . $newName;
		//根据要保存的类型拼接函数名
		$func = 'image' . $this->type;
		$func($newRes, $filePath);
		//释放资源
		imagedestroy($imageRes);
		imagedestroy($newRes);
	}
	
	protected function kidOfImage($srcImg, $size, $imgInfo)
	{
		//传入新的尺寸，创建一个指定尺寸的图片
		$newImg = imagecreatetruecolor($size['old_w'], $size['old_h']);		
		//定义透明色
		$otsc = imagecolortransparent($srcImg);
		if ($otsc >= 0) {
			//取得透明色
			$transparentcolor = imagecolorsforindex($srcImg, $otsc);
			//创建透明色
			$newtransparentcolor = imagecolorallocate(
				$newImg,
				$transparentcolor['red'],
				$transparentcolor['green'],
				$transparentcolor['blue']
			);
		} else {
			//将黑色作为透明色，因为创建图像后在第一次分配颜色时背景默认为黑色
			$newtransparentcolor = imagecolorallocate($newImg, 0, 0, 0);
		}
		//背景填充透明
		imagefill( $newImg, 0, 0, $newtransparentcolor);		 
		imagecolortransparent($newImg, $newtransparentcolor);

		imagecopyresampled( $newImg, $srcImg, $size['x'], $size['y'], 0, 0, $size["new_w"], $size["new_h"], $imgInfo["width"], $imgInfo["height"] );
		return $newImg;
	}


	/*
	$width:最终缩放的宽度
	$height:最终缩放的高度
	$imgInfo:原始图片的宽度和高度
	*/
	protected function getNewSize($width, $height, $imgInfo)
	{
		$size['old_w'] = $width;
		$size['old_h'] = $height;
		
		$scaleWidth = $width / $imgInfo['width'];
		$scaleHeight = $height / $imgInfo['height'];
		$scaleFinal = min($scaleWidth, $scaleHeight);

		$size['new_w'] = round($imgInfo['width'] * $scaleFinal);
		$size['new_h'] = round($imgInfo['height'] * $scaleFinal);
		if ($scaleWidth < $scaleHeight) {
			$size['x'] = 0;
			$size['y'] = round(abs($size['new_h'] - $height) / 2);
		} else {
			$size['y'] = 0;
			$size['x'] = round(abs($size['new_w'] - $width) / 2);
		}
		return $size;
	}
	
	protected function createNewName($prefix, $dstPath)
	{
		if ($this->isRandName) {
			return $prefix . uniqid() . '.' . $this->type;
		} else {
			return $prefix . pathinfo($dstPath)['name'];
		}
	}
	
	//给我一个图片的路径，我将所有的信息得到，返回给你
	static function getImageInfo($imagePath)
	{
		//var_dump(getimagesize($imagePath));
		$info = getimagesize($imagePath);
		$data['width'] = $info[0];
		$data['height'] = $info[1];
		$data['mime'] = $info['mime'];
		return $data;
	}
	
	//给我图片的信息，我会根据图片的mime类型使用不同的函数打开
	static function openAnyImage($imagePath)
	{
		//取出mime类型
		$info = self::getImageInfo($imagePath);
		$mime = $info['mime'];
		switch ($mime) {
			case 'image/png':
				$res = imagecreatefrompng($imagePath);
				break;
			case 'image/gif':
				$res = imagecreatefromgif($imagePath);
				break;
			case 'image/jpeg':
				$res = imagecreatefromjpeg($imagePath);
				break;
			default:
				die('哥们，你这图片不行，让我无法撸代码');
		}
		return $res;
	}
}
























