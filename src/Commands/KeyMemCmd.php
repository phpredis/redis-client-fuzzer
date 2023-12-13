<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyMemCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), $this->rng_mem()];
    }

    public function raw_args(): array {
        return [$this->rng_key(), $this->rng_mem()];
    }
}
