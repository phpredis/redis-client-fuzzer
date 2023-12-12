<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class IncrDecrByCmd extends Cmd {
    use Traits\NumCmd;
    use Traits\WriteCmd;

    public function args(): array {
        return [$this->get_key(), $this->value()];
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function value(): int|float {
        return rand(-1 * pow(2, 24), pow(2, 24));
    }
}
