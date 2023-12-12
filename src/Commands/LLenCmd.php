<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class LLenCmd extends KeyCmd {
    public function type(): string {
        return 'list';
    }

    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
