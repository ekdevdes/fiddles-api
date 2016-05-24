<?php

require_once("../base.php");
require_once("../translator.php");
require_once("../aes.php");
require_once("../shell.php");
require_once("../../CloudApp-API-Wrapper/API.php");

header("Content-Type:application/json");


if(isset($_GET['service']) && isset($_POST['username']) && isset($_POST['pw'])){
	$aes = new AESCrypt();

	if($_GET['service'] == "cloudapp"){

		try {

			$pw = $aes->decrypt($_POST['pw'], TRUE);
			$cloud = new Cloud_API($_POST['username'],$pw,'Fiddles App');
			$resp = $cloud->addFile('fiddles_auth_check.txt');
			$href = $resp->href;
			$item = $cloud->getItem($href);
			$cloud->deleteItem($item);

			echo Base::makeResp(Base::NEC, "valid credentials", NULL);

		} catch(Cloud_Exception $e) {

			if($e->getCode() == 4){
				echo Base::makeResp(4, "invalid credentials", NULL, TRUE);
			}else {
				echo Base::makeResp(Base::NEC, "valid credentials", NULL);
			}

		}

	} else if($_GET['service'] == "github"){
		$username = $_POST['username'];
		$pw = $aes->decrypt($_POST['pw'], true);
		$data = json_decode(Shell::exec("curl https://api.github.com -u \"$username:$pw\""));

		if(isset($data->message) && $data->message == "Bad credentials"){
			echo Base::makeResp(4, "invalid credentials", NULL, TRUE);
		} else {
			echo Base::makeResp(Base::NEC, "valid credentials", NULL);
		}
	}

}