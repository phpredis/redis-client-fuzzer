<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait StringCmd {
    public function type(): string {
        return 'string';
    }
}
