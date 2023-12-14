<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class BLRPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    private function args_impl(int $rng, bool $cluster) {
        $args = [];

        $keys = $cluster ? $this->rng_slot_keys() : $this->rng_keys();
        if (($rng & (1 << 0)) !== 0)
            $args[] = $keys;
        else {
            $args = array_merge($args, $keys);
        }

        $args[] = $this->rng_float(0.0001, 0.0004);

        return $args;
    }

    public function args(): array {
        return $this->args_impl(rand(), false);
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        return $this->args_impl(rand(), true);
    }
}
