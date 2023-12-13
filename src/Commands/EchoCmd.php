<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class EchoCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\AnyType;

    public function args(): array {
        return ["This is a special message: " . uniqid()];
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        return [uniqid(), "This is a special cluster message: " . uniqid()];
    }
}
