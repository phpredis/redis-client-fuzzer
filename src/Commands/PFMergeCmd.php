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

    public function cluster_args(): array {
        $keys = $this->rng_slot_keys();
        $key0 = sprintf('{%s}-merge', $keys[0]);

        return [$key0, $keys];
    }
}
