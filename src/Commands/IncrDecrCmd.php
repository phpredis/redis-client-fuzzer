<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class IncrDecrCmd extends Cmd {
    use Traits\NumCmd;
    use Traits\WriteCmd;

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->rng_key()];
        } else {
            return [$this->rng_key(), rand(-1 * pow(2, 24), pow(2, 24))];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }
}
