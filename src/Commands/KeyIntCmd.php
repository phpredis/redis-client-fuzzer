<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyIntCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), $this->get_int()];
    }

    public function raw_args(): array {
        return $this->args();
    }

    abstract public function get_int(): int;
}
