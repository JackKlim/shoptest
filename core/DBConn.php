<?php

class DBConn {
	public $nnn;

	private $_dbcon;

	private static $_instance = null;

	private function __construct() {
		$this->_dbcon = new PDO("mysql:host=localhost;dbname=shop;charset=utf8","root","");
	}

	private function __clone() {}

	public static function getInstance() {
		if(self::$_instance == null) {
			self::$_instance = new DBConn();
		}
		return self::$_instance;
	}

	public function getConn() {
		return $this->_dbcon;
	}
}