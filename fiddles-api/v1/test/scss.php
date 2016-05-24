<?php

header("Content-Type:application/json");

require_once 'scss.inc.php';

function create_or_update_file($code){
	// make this dynamic with a slug.css as the file name, replacing "slug" the actual slug passed in through the GET url parameter
	if(file_exists("./1WbCQ.css")){
		file_put_contents('1WbCQ.css', $code);
	}else{
		$my_file = '1WbCQ.css';
		$handle = fopen($my_file, 'w');
		fwrite($handle, $code);
		fclose($handle);
	}
}

$scss = new scssc();
$file = file_get_contents("./1WbCQ.scss", FILE_USE_INCLUDE_PATH);

try{
	$code = $scss->compile($file);
	create_or_update_file($code);
	
	echo json_encode(["code" => "200","msg" => $code]);
}catch (Exception $e){
	$errorMsg = $e->getMessage();
	$message = ucfirst(str_replace("line:", "on line ", $errorMsg));
	
	echo json_encode(["err" => ["code" => 509,"msg" => $message]]);
}