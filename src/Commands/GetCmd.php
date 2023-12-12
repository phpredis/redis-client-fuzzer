<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class GetCmd extends KeyCmd {
    public function flags(): int {
        return Cmd::READ_CMD;
    }

    public function type(): mixed {
        return 'string';
    }
}
