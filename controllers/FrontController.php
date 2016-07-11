<?php

class FrontController {

	private static $_instance = null;

	private function __construct() {}
	private function __clone() {}

	static public function getInstance() {
		if (self::$_instance == null) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function run() {
		$request = trim(explode("?",$_SERVER["REQUEST_URI"])[0],"/");

		$controllerName = !empty(explode("/",$request)[1]) ? ucfirst(explode("/",$request)[1]). "Controller" : "IndexController";
		$methodName = (!empty(@$m = explode("/",$request)[2])) ? $m."Action" : "indexAction";

		//var_dump($controllerName);
		//var_dump($methodName);

		if(class_exists($controllerName)) {
			$ctrl = new $controllerName();
			if(method_exists($ctrl, $methodName) && $ctrl instanceof IController) {
				$ctrl->$methodName();
			}else {
				echo "<h1>404</h1><p>METHOD not found</p>";
			}
		}else {
			echo "<h1>404</h1><p>CONTROLLER not found</p>";
		}
		
	}

}