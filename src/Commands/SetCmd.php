<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetCmd extends Cmd {
    public function flags(): int {
        return Cmd::WRITE_CMD;
    }

    public function type(): mixed {
        return 'string';
    }

    public function args(): array {
        return [$this->get_key(), $this->get_val()];
    }
}
