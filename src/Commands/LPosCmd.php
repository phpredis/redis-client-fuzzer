<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LPosCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ListCmd;

    public function args(): array {
        $args = [$this->rng_key(), $this->rng_mem()];

        if ($this->rng_choice()) {
            if ($this->rng_choice()) {
                $rank = $this->rng() % $this->context->mems();
                if ($rank == 0) $rank = -1 * $this->context->mems();
                $opts['rank'] = $rank;
            }
            if ($this->rng_choice())
                $opts['count'] = $this->rng() % $this->context->mems();
            if ($this->rng_choice())
                $opts['maxlen'] = $this->rng() % $this->context->mems();

            if ( ! isset($opts))
                $opts = [];

            $args[] = $opts;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
