<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LInsertCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    protected function rng_op(): string {
        return rand(1, 2) == 1 ? 'before' : 'after';
    }

    public function args(): array {
        return [$this->rng_key(), $this->rng_op(), $this->rng_mem(), $this->rng_mem()];
    }

    public function raw_args(): array {
        return [];
    }
}
