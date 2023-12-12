<?php

namespace Phpredis\RedisClientFuzzer\Commands\Traits;

use Phpredis\RedisClientFuzzer\Commands\Cmd;

trait ListCmd {
    public function type(): string {
        return 'list';
    }
}
