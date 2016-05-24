<?php
header("Content-Type:application/json");

include_once 'php-markdown/markdown.php';

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

$file = file_get_contents("./1WbCQ.md", FILE_USE_INCLUDE_PATH);
$code = markdown($file);
create_or_update_file($code);

echo json_encode(["code" => "200","msg" => $code]);