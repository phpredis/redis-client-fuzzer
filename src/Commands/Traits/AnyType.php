<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait AnyType {
    public function type(): mixed {
        return Cmd::ANY_TYPE;
    }
}
