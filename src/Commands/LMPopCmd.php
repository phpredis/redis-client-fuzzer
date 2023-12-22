<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LMPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        $args = [$this->rng_keys(), $this->rng_choice() ? 'LEFT' : 'RIGHT'];
        if ($this->rng_choice())
            $args[] = ($this->rng() % $this->context->mems()) + 1;

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
