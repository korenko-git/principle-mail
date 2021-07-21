<?php
namespace Classes;
use Classes\Common;
use mysqli;

class DB {
	private static $instance;
	private  $status;
	private $MySQLi;
	
	private function __construct(array $dbOptions){
		try {			
			$this->MySQLi = @ new mysqli(	
				$dbOptions['db_host'],
				$dbOptions['db_user'],
				$dbOptions['db_pass'],
				$dbOptions['db_name']);

			if (mysqli_connect_errno()) {
				throw new Exception('Ошибка базы данных.');
			}

			$this->MySQLi->set_charset("utf8");
			$this->status = true;
		 } catch (Exception $e) {
			$this->status = false;
		//	  echo $e->getMessage();
		 }		
	}

	public static function init() {
		if(self::$instance instanceof self){
			return false;
		}
		
		self::$instance = new self(Common::$dbOptions);
	}
	
	public static function getMySQLiObject() {
		return self::$instance->MySQLi;
	}
	
	public static function getStatus() {
		return self::$instance->status;
	}
	
	public static function getlastID() {
		return self::$instance->MySQLi->insert_id;
	}

	public static function query($q) {
		return self::$instance->MySQLi->query($q);
	}
	
	public static function multi_query($q) {
		return self::$instance->MySQLi->multi_query($q);
	}
	
	public static function esc($str) {
		return trim(self::$instance->MySQLi->real_escape_string(htmlspecialchars($str)));
	}

	public static function uEsc($str) {
		return htmlspecialchars_decode($str);
	}
}

?>