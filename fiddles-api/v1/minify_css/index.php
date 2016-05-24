<?php 

header('Content-Type:application/json');

require '../fiddle.php';

echo json_encode(array(
	"original_css" => $_POST['code'],
	"minified_css" => json_encode(Fiddle::minify_css($_POST['code']))
));