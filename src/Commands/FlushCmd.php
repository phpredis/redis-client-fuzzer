<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class FlushCmd extends Cmd {
    use Traits\FlushCmd;
    use Traits\AnyType;

    public function args(): array {
        if ($this->rng_choice()) {
            return [$this->rng_choice()];
        } else {
            return [];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        return array_merge([uniqid()], $this->args());
    }
}
