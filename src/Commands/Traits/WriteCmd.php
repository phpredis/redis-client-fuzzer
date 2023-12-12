<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait WriteCmd {
    public function flags(): int {
        return Cmd::WRITE_CMD;
    }
}
