<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetRangeCmd extends RangeCmd {
    use Traits\StringCmd;

    public function args(): array {
        return [$this->get_key(), ...$this->rng_range()];
    }

    public function raw_args(): array {
        return [$This->get_key(), ...$this->rng_range()];
    }
}
