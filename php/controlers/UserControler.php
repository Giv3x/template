<?php
//session_start();
include('php/models/UserModel.php');

class UserControler {

	function __construct() {
	}

	function login() {
		$response = array();
		if(!isset($_REQUEST['username']) || !isset($_REQUEST['password'])) {
			$response = array('success' => false, 'response' => 'wrong username/password');
		} else {
			$userModel = new UserModel();
			$response = $userModel->getLoginInfo($_REQUEST['username'], $_REQUEST['password']);
			if($response['success']) {
				$_SESSION['id11'] = $response['response']['username'];
				$_SESSION['role'] = $response['response']['role'];

				if(isset($_REQUEST['stayloggedin']) && $_REQUEST['stayloggedin'] == 'on') {
					$this->logSession($_REQUEST['username']);
				}
			}
		}

		return $response;
	}

	function register() {
		$response = array();
		$model = new UserModel();

		if($_REQUEST['password'] != $_REQUEST['repeated_password'])
			$respose = array('success' => false, 'response' => 'passwords don\'t match');
		else {
			$userInfo = array('username'=>$_REQUEST['username'],
						'password'=>$_REQUEST['password'],
						'email'=>$_REQUEST['email'],
						'cityid'=>$_REQUEST['cityid'],
						'salt'=>rand(1000,9999));
			$userInfo['password'] = hash("sha256", $userInfo['password'].$userInfo['salt']);
			$response = $model->register($userInfo);
		}

		return $response;
	}

	function logout() {
		$model = new UserModel();
		$name = hash("sha256", $_SERVER['REMOTE_ADDR'].'GL Bros');

		if(isset($_COOKIE[$name])) {
			$array = explode('&&', $_COOKIE[$name]);
			$model->destroyCookies($array[0], $array[1]);
			unset($_COOKIE[$name]);
			setcookie($name, '', time()-3600);
		}

		if(isset($_SESSION['id11'])) unset($_SESSION['id11']);
		if(isset($_SESSION['role'])) unset($_SESSION['role']);
		session_destroy();
	}

	private function logSession($username) {
		$model = new UserModel();

		$model->logSession($username);
	}
}


?>