<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZCountCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $min = rand(-1024, 1024);
        $max = rand($min, $min + 1024);
        return [$this->rng_key(), $min, $max];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
