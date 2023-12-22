<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait BlockingWriteCmd {
    public function flags(): int {
        return Cmd::WRITE_CMD | Cmd::BLOCKING_CMD;
    }
}
