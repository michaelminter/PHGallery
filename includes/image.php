<?php
header("Content-Type: image/jpeg");

if(!function_exists('imagecreatetruecolor')) {
    displayError('GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library');
}

$thumb = 100;
$image = $_GET['image'];

list($width, $height) = getimagesize($image);

$ratio = $width/$height;
		
if ($ratio > 1) {
	$new_width  = $thumb;
	$new_height = $thumb/$ratio;
} else {
	$new_height = $thumb;
	$new_width  = $thumb*$ratio;
}

$info = GetImageSize($image);

if (empty($info)) {
  exit("The file ".$image." doesn't seem to be an image.");
}

$width  = $info[0];
$height = $info[1];
$mime   = $info['mime'];

$type = substr(strrchr($mime, '/'), 1);

switch($type) {
	case 'jpeg':
		$image_create_func = 'imagecreatefromjpeg';
		$image_save_func = 'ImageJPEG';
		$new_image_ext = 'jpg';
	break;

	case 'png':
		$image_create_func = 'ImageCreateFromPNG';
		$image_save_func = 'ImagePNG';
		$new_image_ext = 'png';
	break;

	case 'bmp':
		$image_create_func = 'ImageCreateFromBMP';
		$image_save_func = 'ImageBMP';
		$new_image_ext = 'bmp';
	break;

	case 'gif':
		$image_create_func = 'ImageCreateFromGIF';
		$image_save_func = 'ImageGIF';
		$new_image_ext = 'gif';
	break;

	case 'vnd.wap.wbmp':
		$image_create_func = 'ImageCreateFromWBMP';
		$image_save_func = 'ImageWBMP';
		$new_image_ext = 'bmp';
	break;

	case 'xbm':
		$image_create_func = 'ImageCreateFromXBM';
		$image_save_func = 'ImageXBM';
		$new_image_ext = 'xbm';
	break;

	default:
		$image_create_func = 'ImageCreateFromJPEG';
		$image_save_func = 'ImageJPEG';
		$new_image_ext = 'jpg';
}

//$create = $image_create_func($image);
$create = imagecreatefromjpeg($image);

$template = imagecreatetruecolor($new_width,$new_height);

imagecopyresized($template, $create, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

ImageJpeg($template);

?>