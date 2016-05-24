<?php

class Shell{

	public static function exec($cmd){
		return shell_exec($cmd);
	}

};