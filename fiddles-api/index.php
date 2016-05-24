<?php

header("Content-Type:application/json");

echo @json_encode([
	"documentation_url" => "http://api.fiddlesapp.co/docs/",
	"base_url" => "http://api.fiddlesapp.co",
	"current_version" => "v1",
	"bleeding_edge_version" => "v2"
]);