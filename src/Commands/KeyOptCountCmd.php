<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyOptCountCmd extends Cmd {
    public function get_count() {
        return rand(1, rand(0, $this->context->mems()));
    }

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->rng_key(), $this->get_count()];
        } else {
            return [$this->rng_key()];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }
}
