<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HDelCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\HashCmd;

    public function args(): array {
        return [$this->rng_key(), ...$this->rng_mems()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
