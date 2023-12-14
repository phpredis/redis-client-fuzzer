<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PFAddCmd extends Cmd {
    use Traits\HLLType;
    use Traits\WriteCmd;

    public function args(): array {
        return [$this->rng_key(), $this->rng_mems()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
