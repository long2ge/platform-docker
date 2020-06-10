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
        'git pull',
        'docker-compose -f /work/compose/docker-compose.yml run --no-deps --rm php-fpm-platform-api composer install',
        'docker-compose -f /work/compose/docker-compose.yml run --no-deps --rm php-fpm-platform-api php artisan app:init',
        'docker-compose -f /work/compose/docker-compose.yml run --no-deps --rm php-fpm-platform-api php artisan app:update',
        'docker-compose -f /work/compose/docker-compose.yml restart php-fpm-platform-api', // 启动Swoole
    ];

    foreach ($commands as $command) {
        echo shell_exec($command);
    }

    $response->end("ok");

});
$http->start();