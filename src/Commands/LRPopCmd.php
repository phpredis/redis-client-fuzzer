<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class LRPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->rng_key(), rand(1, $this->context->mems())];
        } else {
            return [$this->rng_key()];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }
}
