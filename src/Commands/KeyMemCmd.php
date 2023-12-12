<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class KeyMemCmd extends Cmd {
    public function args(): array {
        return [$this->get_key(), $this->get_mem()];
    }

    public function raw_args(): array {
        return [$this->get_key(), $this->get_mem()];
    }
}
