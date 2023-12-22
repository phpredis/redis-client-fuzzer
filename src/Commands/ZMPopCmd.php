<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZMPopCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    private $from = ['MIN' => 1, 'MAX' => 1];

    public function args(): array {
        $args = [$this->rng_keys(), array_rand($this->from)];
        if (rand(1, 2) == 1)
            $args[] = rand(1, 10);
        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
