<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2020/6/7
 * Time: 4:28 PM
 */

$http = new Swoole\Http\Server("0.0.0.0", 9501);
$http->on('request', function ($request, $response) {

    $commands = [
        'git pull', // 拉代码
        'docker run --rm php-fpm-platform composer install',
        'docker run --rm php-fpm-platform php artisan app:init',
        'docker run --rm php-fpm-platform php artisan app:update',
        'cd ../../compose && docker-compose php-fpm-platform-swoole restart', // 启动Swoole
    ];

    foreach ($commands as $command) {
        shell_exec($command);
    }

    $response->end("ok");

});
$http->start();