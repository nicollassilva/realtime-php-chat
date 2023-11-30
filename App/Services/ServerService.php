<?php

namespace App\Services;

use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class ServerService
{
    private IoServer $server;

    public function __construct()
    {
        $this->initServer();
    }

    private function initServer()
    {
        $this->server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new ChatService()
                )
            ),
            '8080'
        );
    }

    public function run()
    {
        $this->server->run();
    }
}