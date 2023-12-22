<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZRangeByScoreGenericCmd  extends Cmd {
    use traits\ZSetCmd;
    use traits\ReadCmd;

    abstract protected function rng_range(): array;

    public function args(): array {
        list($min, $max) = $this->rng_range();

        $args = [$this->rng_key(), $min, $max];
        if ($this->rng_choice()) {
            $opts = [];
            if ($this->rng_choice())
                $opts['withscores'] = $this->rng_choice();
            if ($this->rng_choice()) {
                $opts['limit'] = [
                    $this->rng() % $this->context->mems(),
                    $this->rng() % $this->context->mems(),
                ];
            }

            $args[] = $opts;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
