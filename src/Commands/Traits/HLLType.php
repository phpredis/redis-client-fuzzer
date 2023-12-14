<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait HLLType {
    public function type(): mixed {
        return 'hll';
    }
}
