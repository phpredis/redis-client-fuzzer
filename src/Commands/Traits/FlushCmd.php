<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait FlushCmd {
    public function flags(): int {
        return Cmd::FLUSH_CMD | Cmd::WRITE_CMD | Cmd::DEL_CMD;
    }
}
