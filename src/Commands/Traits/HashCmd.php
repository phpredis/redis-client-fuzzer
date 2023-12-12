<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait HashCmd {
    public function type(): string {
        return 'hash';
    }
}
