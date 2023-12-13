<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyIntValCmd extends Cmd {
    abstract public function get_int(): int;

    public function args(): array {
        return [$this->rng_key(), $this->get_int(), $this->get_val()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
