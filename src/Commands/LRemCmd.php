<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LRemCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        $args = [$this->rng_key(), $this->rng_mem()];

        if (rand(1, 2) == 1)
            $args[] = rand(1, 60);

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
