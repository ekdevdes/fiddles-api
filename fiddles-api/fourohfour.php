<?php

header("Content-Type:application/json");

echo @json_encode([
	"documentation_url" => "http://api.fiddlesapp.co/docs/",
	"err_msg" => "Not Found"
]);