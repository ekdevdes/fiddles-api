<?php

	require_once 'aes.php';
	require_once 'shell.php';

	$aes = new AESCrypt();

	echo json_encode(["pw" => $aes->decrypt($_POST['pw'], true)]);
