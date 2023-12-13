<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class MKeyCmd extends Cmd {
    public function args(): array {
        return [$this->get_keys()];
    }

    public function raw_args(): array {
        return $this->get_keys();
    }
}