<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyKeyCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), $this->rng_key()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
