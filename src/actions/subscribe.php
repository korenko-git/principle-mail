<?php
require_once '../vendor/autoload.php';

use Classes\DB;
use Classes\Utils;

$name = Utils::secure_read($_POST["name"]);
$mail = Utils::secure_read($_POST["mail"]);

DB::init();

$existMail = DB::query("SELECT `status`, `token` FROM `pr_users` WHERE `mail` = '$mail')");
if ($existMail && $existMail->num_rows != 0) {
  $user = $resultUsers->fetch_object();
  DB::query("UPDATE `pr_users` SET `status` = 1 WHERE `mail` = ".($user->mail)." AND `token` = ".($user->token)."");  
  return;
}

$token = md5($name.$mail."secret_salt");
DB::query("INSERT INTO `pr_users` (`name`, `mail`, `token`) VALUES ('$name', '$mail', '$token')");