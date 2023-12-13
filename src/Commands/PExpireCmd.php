<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PExpireCmd extends ExpireGenericCmd {
    public function get_tty(): int {
        return rand(0, 60000);
    }

    public function args(): array {
        return [$this->rng_key(), $this->get_tty()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
