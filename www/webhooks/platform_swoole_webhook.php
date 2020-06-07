<?php
/**
 * Created by PhpStorm.
 * User: long
 * Date: 2020/6/7
 * Time: 4:28 PM
 */

$http = new Swoole\Http\Server("0.0.0.0", 9501);
$http->on('request', function ($request, $response) {

    /**
     *  维护脚本
     *   vi etc/supervisord.d/xxxx.ini
     *  [program:laravel-s-test]
     *  directory=/var/wwww/laravel-s-test
     *  command=/usr/local/bin/php bin/laravels start -i
     *  numprocs=1
     *  autostart=true
     *  autorestart=true
     *  startretries=3
     *  user=www-data
     *  redirect_stderr=true
     *  stdout_logfile=/var/log/supervisor/%(program_name)s.log
     *
     *  systemctl start supervisord
     *
     *  supervisorctl reread (首次,重新读取配置)
     *
     *  supervisorctl start webhook
     */

    $commands = [
        'git pull', // 拉代码
        'docker run --rm compose_php-fpm-platform composer install',
        'docker run --rm compose_php-fpm-platform php artisan app:init',
        'docker run --rm compose_php-fpm-platform php artisan app:update',
        'cd ../../compose && docker-compose restart php-fpm-platform-swoole', // 启动Swoole
    ];

    foreach ($commands as $command) {
        shell_exec($command);
    }

    $response->end("ok");

});
$http->start();