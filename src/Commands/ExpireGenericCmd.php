<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ExpireGenericCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\AnyType;

    private $modes = ['NX', 'XX', 'GT', 'LT'];

    public function rng_mode(): string|null {
        return $this->modes[array_rand($this->modes)];
    }

    abstract public function get_tty(): int;
}
