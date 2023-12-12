<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Cmd.php';

abstract class MKeyCmd extends Cmd {
    public function args(): array {
        return [$this->get_keys()];
    }

    public function raw_args(): array {
        return $this->get_keys();
    }
}
