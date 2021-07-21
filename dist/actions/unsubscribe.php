<?php
require '../vendor/autoload.php';

use Classes\DB;
use Classes\Utils;

$mail = Utils::secure_read($_GET["mail"]);
$token = Utils::secure_read($_GET["token"]);

DB::init();
DB::query("UPDATE `pr_users` SET `status` = 0 WHERE `mail` = '$mail' AND `token` = '$token'");