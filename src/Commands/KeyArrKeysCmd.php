<?php

namespace Phpredis\RedisCLientFuzzer\Commands;

abstract class KeyArrKeysCmd extends Cmd {
    public function args(): array {
        return [$this->rng_key(), $this->rng_keys()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
