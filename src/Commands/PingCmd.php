<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PingCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\AnyType;

    public function args(): array {
        if (rand(1, 2) == 1) {
            return ["This is a special message: " . uniqid()];
        } else {
            return [];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        if (rand(1, 2) == 1) {
            return [uniqid(), "This is a special cluster message: " . uniqid()];
        } else {
            return [uniqid()];
        }
    }
}
