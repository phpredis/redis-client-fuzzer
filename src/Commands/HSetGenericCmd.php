<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class HSetGenericCmd extends Cmd {
    use Traits\HashCmd;
    use Traits\WriteCmd;

    public function args(): array {
        return [$this->rng_key(), $this->rng_mem(), $this->rng_val()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
