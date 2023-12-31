<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class IncrDecrByCmd extends Cmd {
    use Traits\WriteCmd;

    public function type(): string {
        return is_float($this->value()) ? 'float' : 'int';
    }

    public function args(): array {
        return [$this->rng_key(), $this->value()];
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function value(): int|float {
        return rand(-1 * pow(2, 24), pow(2, 24));
    }
}
