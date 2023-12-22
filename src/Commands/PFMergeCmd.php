<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PFMergeCmd extends Cmd {
    use Traits\HLLType;
    use Traits\ReadCmd;

    public function args(): array {
        return [$this->rng_key(), $this->rng_keys()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
