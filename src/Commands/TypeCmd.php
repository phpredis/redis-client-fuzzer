<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class TypeCmd extends KeyCmd {
    public function type(): array {
        return ['string', 'list', 'hash', 'set', 'zset'];
    }

    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
