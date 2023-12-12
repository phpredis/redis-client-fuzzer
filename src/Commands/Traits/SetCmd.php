<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait SetCmd {
    public function type(): string {
        return 'set';
    }
}
