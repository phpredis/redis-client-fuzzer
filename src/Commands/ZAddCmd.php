<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZAddCmd extends Cmd {
    use Traits\ZSetCmd;
    use Traits\WriteCmd;

    public function args(): array {
        $args = [$this->rng_key()];

        for ($i = 0; $i < rand(1, $this->context->mems()); $i++) {
            $args[] = $this->rng_float(0, 1024);
            $args[] = $this->rng_mem();
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
