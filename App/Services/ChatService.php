<?php

namespace App\Services;

use SplObjectStorage;
use Ratchet\ConnectionInterface;
use function Laravel\Prompts\{error, info, note};
use Ratchet\MessageComponentInterface;

class ChatService implements MessageComponentInterface
{
    protected SplObjectStorage $clients;

    public function __construct() {
        $this->clients = new SplObjectStorage;

        note("[SYSTEM] Chat server has started on port 8080");
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        info("[SYSTEM] New connection! ({$conn->resourceId})");
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            $client->send($msg);
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        note("[SYSTEM] Connection {$conn->resourceId} has disconnected");
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        error("[SYSTEM] An error has occurred: {$e->getMessage()}");

        $conn->close();
    }
}