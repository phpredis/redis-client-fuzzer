<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetBitCmd extends Cmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;

    public function args(): array {
        return [$this->rng_key(), rand(0, $this->context->strlen()), rand(0, 1)];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
