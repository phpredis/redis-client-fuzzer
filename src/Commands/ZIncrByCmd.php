<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZIncrByCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        return [$this->rng_key(), $this->rng_float(), $this->rng_mem()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
