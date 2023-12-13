<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class MKeyCmd extends Cmd {
    public function args(): array {
        return [$this->rng_keys()];
    }

    public function raw_args(): array {
        return $this->rng_keys();
    }

    public function cluster_args(): array {
        return [$this->rng_slot_keys()];
    }

    public function raw_cluster_args(): array {
        return $this->rng_slot_keys();
    }
}
