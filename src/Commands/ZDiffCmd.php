<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZDiffCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $args = [$this->rng_keys()];
        if ($this->rng_choice()) {
            $opts = [];
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
