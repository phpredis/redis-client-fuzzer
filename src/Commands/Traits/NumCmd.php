<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait NumCmd {
    public function type(): string {
        return 'num';
    }
}
