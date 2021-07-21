<?php 
namespace Classes;

class Theme {
  private static $img = null;
  public static $acriveTheme = 0;
  public static $theme = array(
    array(
      'bgColor' => array(18, 18, 21),
      'textColor' => array(243, 243, 245),
    ),
    array(
      'bgColor' => array(178, 210, 235),
      'textColor' => array(9, 21, 35),
    ),
    array(
      'bgColor' => array(31, 36, 55),
      'textColor' => array(242, 248, 254),
    ),
    array(
      'bgColor' => array(255, 252, 238),
      'textColor' => array(8, 6, 9),
    ),
  );

  public static function init(&$image) {
    self::$acriveTheme = self::$theme[array_rand(self::$theme, 1)];
    self::$img = $image;
  }

  public static function getColorId($objectName) {
    return imagecolorallocate(self::$img, 
      self::$acriveTheme[$objectName][0], 
      self::$acriveTheme[$objectName][1], 
      self::$acriveTheme[$objectName][2]
    );
  }
}