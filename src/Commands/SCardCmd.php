<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class SCardCmd extends KeyCmd {
    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
