<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class TypeCmd extends KeyCmd {
    public function type(): array {
        return ['string', 'list', 'hash', 'set', 'zset'];
    }

    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
