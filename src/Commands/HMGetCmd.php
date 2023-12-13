<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HMGetCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;

    public function args(): array {
        return [$this->rng_key(), $this->get_mems()];
    }

    public function raw_args(): array {
        return [$this->rng_key(), ...$this->get_mems()];
    }
}
