<?php

include_once '../fiddle.php';

header('Content-Type:application/json');

if(isset($_GET['html_lang']) && isset($_GET['css_lang']) && isset($_GET['js_lang'])){

$css = "";
$js = "";
$html = "";
$error_count = 0;

// error code meanings

// 502 - translation not supported
// 507 - coffeescript parsing error
// 509 - scss parsing error
// 510 - less parsing error
// 511 - haml parsing error


if($_GET['css_lang'] == "css"){
	$css = $_POST['css'];
}else{
	$temp_css = Fiddle::translate(array(
		'from' => $_GET['css_lang'],
		'to' => "css",
		'text' => $_POST['css'],
		'slug' => $_GET["slug"]
	));
	
	if(is_array($temp_css)){
		$error_count++;
	}
	
	$css = $temp_css;
}

if($_GET['js_lang'] == "js"){
	$js = $_POST['js'];
}else{
	$temp_js = Fiddle::translate(array(
		'from' => $_GET['js_lang'],
		'to' => "js",
		'text' => $_POST['js'],
		"slug" => $_GET["slug"]
	));
	
	$js = $temp_js;
	
	if(is_array($js) && array_key_exists("err", $js)){
		$error_count++;
	}
}


if($_GET['html_lang'] == "html"){
	$html = $_POST['html'];
}else{
	$temp_html = Fiddle::translate(array(
		'from' => $_GET['html_lang'],
		'to' => "html",
		'text' => $_POST['html'],
		"slug" => $_GET["slug"]
	));
	
	$html = $temp_html;
	
	if(is_array($html) && array_key_exists("err", $html)){
		$error_count++;
	}
	
}


echo json_encode(array(
	"translated_css" => $css,
	"translated_js" => $js,
	"translated_html" =>$html,
	"error_count" => $error_count
));

	
	
}else{
	echo json_encode(array("err" => array("msg" => "language not supported","code" => 502)));
}