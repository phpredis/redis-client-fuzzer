<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait DelCmd {
    public function flags(): int {
        return Cmd::WRITE_CMD | Cmd::DEL_CMD;
    }
}
