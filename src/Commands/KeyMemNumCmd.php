<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyMemNumCmd extends Cmd {
    abstract public function get_num(): int|float;

    public function args(): array {
        return [$this->rng_key(), $this->rng_mem(), $this->get_num()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}

