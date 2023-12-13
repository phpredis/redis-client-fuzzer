<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyNMemsCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), ...$this->rng_mems()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
