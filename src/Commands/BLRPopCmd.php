<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class BLRPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        $args = [];

        $keys = $this->rng_keys();
        if ($this->rng_choice()) {
            $args[] = $keys;
        } else {
            $args = array_merge($args, $keys);
        }

        $args[] = $this->rng_float(0.0001, 0.0004);

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
