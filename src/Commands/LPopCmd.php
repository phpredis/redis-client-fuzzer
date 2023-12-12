<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Cmd.php';

class LPopCmd extends Cmd {
    public function flags(): int {
        return Cmd::WRITE_CMD;
    }

    public function type(): string {
        return 'list';
    }

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->get_key(), rand(0, $this->context->mems()];
        } else {
            return [$this->get_key()];
        }
    }
}
