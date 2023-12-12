<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\StringCmd;

    public function args(): array {
        return [$this->get_key(), $this->get_val()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
