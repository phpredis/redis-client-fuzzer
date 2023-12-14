<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyValCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), $this->get_val()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}

