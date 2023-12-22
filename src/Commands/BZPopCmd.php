<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class BZPopCmd extends Cmd {
    use Traits\BlockingWriteCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $args = [];

        if ($this->rng_choice()) {
            $keys = $this->rng_keys();
            foreach ($keys as $key)
                $args[] = $key;

            $args[] = $this->rng_float(.002, .004);
        } else {
            $args = [$this->rng_keys(), $this->rng_float(.002, .004)];
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
