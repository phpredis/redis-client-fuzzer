<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class SInterDiffUnionCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;

    public function args(): array {
        return $this->rng_slot_keys();
    }

    public function raw_args(): array {
        return $this->args();
    }
}
