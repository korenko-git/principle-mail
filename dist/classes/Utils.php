<?php
namespace Classes;

class Utils {
  static public function secure_read($value) {
    return htmlspecialchars(stripslashes(trim($value)));
  }
}