<?php
//header('Content-Type: image/png');
//require_once '../../vendor/autoload.php';
require_once "imagettftextboxopt.php";
use Classes\DB;
use Classes\Principle;
use Classes\Theme;

//Principle::$activePrinciple = "work";
[
  'title_eng' => $title_eng,
  'bg_file' => $bg_file,
  'title_header' => $title_header,
  'principle_text' => $principle_text,
]  = Principle::getActivePrinciple();

DB::init();	
$textPrinciple = Principle::getPrincipleByDate(date("Y-m-d"));

$width = $bg_file["width"];
$height = $bg_file["height"];
//putenv('GDFONTPATH=' . realpath('.'));

$langs = ["eng", "rus"];
foreach ($langs as $lang) {

  // dest image
  $dest_image = imagecreatetruecolor($width, $height);
  imagesavealpha($dest_image, true);
  
  Theme::init($dest_image);
  if (Principle::$activePrinciple == "life") Theme::$acriveTheme = Theme::$theme[0];

  // background color
  imagefill($dest_image, 0, 0, Theme::getColorId('bgColor'));


  // background image
  $bgImage = imagecreatefrompng(dirname(__FILE__) . $bg_file["path"]);
  imagecopy($dest_image, $bgImage, 0, 0, 0, 0, $width, $height);

  // text of title image
  imagettftext(
    $dest_image, 
    $title_header["top_font_size"], 0, 
    $title_header["x"], $title_header["y"], 
    Theme::getColorId('textColor'), 
    dirname(__FILE__) . '/CenturyGothicBold.ttf', 
    $title_eng
  );

  imagettftext(
    $dest_image, 
    $title_header["top_font_size"] - 15, 0, 
    $title_header["x"], $title_header["y"] + $title_header["top_font_size"], 
    Theme::getColorId('textColor'), 
    dirname(__FILE__) . '/CenturyGothicRegular.ttf', 
    'OF THE DAY'
  );

  // text of principles
  imagettftextboxopt(
    $dest_image, 
    40, // text size
    0, // angle
    $principle_text["x"], // left position of text
    $principle_text["y"], // top position of text
    Theme::getColorId('textColor'), // color of text
    dirname(__FILE__) . '/CenturyGothicBold.ttf', // name of font file
    trim(preg_replace('/\s+/', ' ', strtoupper($textPrinciple[$lang]))), // text
    array(
      'width' => $width - 159 - 100,
      'line_height' => 50,
      'orientation' => array(ORIENTATION_TOP, ORIENTATION_LEFT),
      'align' => ALIGN_LEFT,
      'v_align' => VALIGN_TOP,
    )
  );

  //echo trim(preg_replace('/\s+/', ' ', strtoupper($textPrinciple[$lang])));

  // output image
  imagepng($dest_image, "$title_eng.$lang.png");

  // destroy all images
  //imagedestroy($bgImage);
  imagedestroy($dest_image);
}