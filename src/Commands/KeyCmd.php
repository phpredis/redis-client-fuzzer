<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
