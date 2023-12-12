<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class TTLCmd extends KeyCmd {
    public function type(): mixed {
        return Cmd::ANY_TYPE;
    }

    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
