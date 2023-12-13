<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ExpireCmd extends ExpireGenericCmd {
    public function get_tty(): int {
        return rand(0, 60);
    }

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->rng_key(), $this->get_tty(), $this->rng_mode()];
        } else {
            return [$this->rng_key(), $this->get_tty()];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }
}
