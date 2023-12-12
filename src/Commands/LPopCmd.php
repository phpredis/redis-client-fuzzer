<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/Cmd.php';

class LPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        if (rand(1, 2) == 1) {
            return [$this->get_key(), rand(0, $this->context->mems())];
        } else {
            return [$this->get_key()];
        }
    }

    public function raw_args(): array {
        return $this->args();
    }
}
