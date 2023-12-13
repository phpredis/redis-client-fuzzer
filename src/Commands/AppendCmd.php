<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class AppendCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\StringCmd;

    public function args(): array {
        return [$this->rng_key(), $this->get_val()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
