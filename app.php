<?php
require __DIR__ . '/vendor/autoload.php';

$whsrv = new WebhookExample\WebhookServer();

$http = new React\Http\HttpServer(function(Psr\Http\Message\ServerRequestInterface $request) use($whsrv) {
    return $whsrv->handler($request);
});

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);
echo "Server running at http://127.0.0.1:8080", PHP_EOL, PHP_EOL;

$whsrv->init();
