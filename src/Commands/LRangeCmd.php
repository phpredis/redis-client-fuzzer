<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LRangeCmd extends RangeCmd {
    use Traits\ListCmd;

    public function args(): array {
        return [$this->rng_key(), ...$this->rng_range($this->context->mems())];
    }

    public function raw_args(): array {
        return [$This->rng_key(), ...$this->rng_range($this->context->mems())];
    }
}
