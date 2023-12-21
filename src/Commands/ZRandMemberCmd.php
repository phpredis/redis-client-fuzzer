<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRandMemberCmd extends Cmd {
    use Traits\ZsetCmd;
    use Traits\ReadCmd;

    public function args(): array {
        $args = [$this->rng_key()];

        if ($this->rng_choice()) {
            $opts = [];
            if ($this->rng_choice())
                $opts['count'] = ($this->rng() % $this->context->mems()) + 1;
            if ($this->rng_choice())
                $opts['withscores'] = $this->rng_choice();

            $args[] = $opts;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
