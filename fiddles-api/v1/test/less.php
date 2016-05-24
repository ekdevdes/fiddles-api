<?php

header("Content-Type:application/json");

include_once 'lessphp/lessc.inc.php';

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

$less = new lessc;

try {

 $code = $less->compileFile("./1WbCQ.less");
 create_or_update_file($code);
 
 echo json_encode(["code" => "200","msg" => $code]);
} catch (Exception $e) {

  $errMsg = $e->getMessage();
  $message = str_replace("parse error: ", "", $errMsg);
  $better_msg = ucfirst(str_replace("./", " in ", $message));
  
  echo json_encode(["err" => ["code" => 510,"msg" => $better_msg]]);
  
  
}