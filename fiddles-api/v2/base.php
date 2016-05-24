<?php

class Base{

	public static $html_file_path = "../../../";
	const ROOT = "http://fiddlesapp.co";
	// NEC stands for No Error Code, which means its the code for success
	const NEC = 0;

	function __construct(){
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public static function html_file_url($slug, $abs = false) {

		if ($abs) {
			return realpath(self::$html_file_path) . "/". $slug . ".html";
		} else {
			return Base::ROOT."/".$slug.".html";
		}

	}

	public static function makeResp($respCode, $msg, $response, $isError = false){
		$resp = array();

		// $respCode can be a string in the case of an error to describe multiple errors (e.g. "1.1, 1.2")
		$resp["meta"]["resp_code"] = $respCode;
		$isError ? $resp["meta"]["err_msg"] = $msg : $resp["meta"]["resp_msg"] = $msg;
		if($isError) {
			is_null($msg) ? $resp["meta"]["err_msg"] = "" : $resp["meta"]["err_msg"] = $msg;
		} else{
			is_null($msg) ? $resp["meta"]["resp_msg"] = "" : $resp["meta"]["resp_msg"] = $msg;
		}
		foreach($_GET as $key => $value) {
			$resp["meta"]["get_params"][$key] = $value;
		}

		foreach($_POST as $key => $value) {
			if($key !== "pw") {
				$resp["meta"]["post_params"][$key] = $value;
			}
		}
		$resp["resp"] = $response;

		return json_encode($resp);
	}

};

// echo Base::resp(Base::NEC, NULL, array("url" => Base::html_file_url($_GET['slug'])));