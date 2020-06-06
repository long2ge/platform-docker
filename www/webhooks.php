<?php
	echo 'webhooks ok';
	
	// git pull
	$command = "git pull";
	shell_exec($command);
	
	// docker exec -it php-fpm-platform composer install
	$command = "docker exec -it php-fpm-platform composer install";
	shell_exec($command);
	
	// 初始化命令
	// docker exec -it php-fpm-platform php artisan app:init
	$command = "docker exec -it php-fpm-platform php artisan app:init";
	shell_exec($command);
	
	// docker exec -it php-fpm-platform php artisan app:update
	$command = "docker exec -it php-fpm-platform php artisan app:update";
	shell_exec($command);
