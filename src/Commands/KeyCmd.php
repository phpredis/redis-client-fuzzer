<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Cmd.php';

abstract class KeyCmd extends Cmd {
    public function args(): array {
        return [$this->get_key()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
