<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait ReadCmd {
    public function flags(): int {
        return Cmd::READ_CMD;
    }
}
