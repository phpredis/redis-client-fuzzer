<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetRangeCmd extends RangeCmd {
    use Traits\StringCmd;

    public function args(): array {
        return [$this->rng_key(), ...$this->rng_range($this->context->strlen())];
    }

    public function raw_args(): array {
        return [$This->rng_key(), ...$this->rng_range($this->context->strlen())];
    }
}
