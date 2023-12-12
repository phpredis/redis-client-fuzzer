<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait ZSetCmd {
    public function type(): string {
        return 'zset';
    }
}
