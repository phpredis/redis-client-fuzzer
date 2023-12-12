<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class SMembersCmd extends KeyCmd {
    public function flags(): int {
        return Cmd::READ_CMD;
    }

    public function type(): string {
        return 'set';
    }
}
