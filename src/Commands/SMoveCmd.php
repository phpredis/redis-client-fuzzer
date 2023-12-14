<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SMoveCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\SetCmd;

    public function args(): array {
        list($src, $dst) = $this->rng_slot_key_pair();
        return [$src, $dst, $this->rng_mem()];
    }

    public function raw_args(): array {
    }
}
