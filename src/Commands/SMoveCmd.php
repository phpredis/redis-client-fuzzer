<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SMoveCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\SetCmd;

    public function args(): array {
        return [$this->rng_key(), $this->rng_key(), $this->rng_mem()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
