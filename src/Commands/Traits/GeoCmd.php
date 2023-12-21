<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait GeoCmd {
    public function type(): string {
        return 'geo';
    }
}
