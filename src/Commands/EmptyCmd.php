<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class EmptyCmd extends Cmd {
    use Traits\AnyType;
    use Traits\ReadCmd;

    public function args(): array {
        return [];
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        return [$this->rng_key()];
    }
}
