<?php

header("Content-Type:application/json");

include_once 'phphaml/library.php';

phphaml\Library::autoload();

function create_or_update_file($code){
	// make this dynamic with a slug.css as the file name, replacing "slug" the actual slug passed in through the GET url parameter
	if(file_exists("./1WbCQ.html")){
		file_put_contents('1WbCQ.html', $code);
	}else{
		$my_file = '1WbCQ.html';
		$handle = fopen($my_file, 'w');
		fwrite($handle, $code);
		fclose($handle);
	}
}

$file = file_get_contents("./1WbCQ.haml", FILE_USE_INCLUDE_PATH);

$parser = new phphaml\haml\Parser($file);

try{
	
	$code = $parser->render();
	create_or_update_file($code);
	
	echo json_encode(["code" => 200,"msg" => $code]);
	
}catch(Exception $e){
	
	$errMsg = $e->getMessage();
	$message = ucfirst(str_replace("Parse error: ", "", $errMsg));
	
	echo json_encode(["err" => ["code" => 511,"msg" => $message]]);
	
}