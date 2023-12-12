<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class MMemCmd extends Cmd {
    public function args(): array {
        return [$this->get_key(), ...$this->get_mems()];
    }

    public function raw_args(): array {
        return [$this->get_key(), ...$this->get_mems()];
    }
}
