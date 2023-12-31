<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SInterCardCmd extends Cmd {
    use Traits\SetCmd;
    use Traits\ReadCmd;

    public function args(): array {
        $args = [$this->rng_keys()];
        if ($this->rng_choice())
            $args[] = $this->rng() % (10 * $this->context->mems());

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
