<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class SInterDiffUnionCmd extends Cmd {
    use Traits\SetCmd;

    public function args(): array {
        $args = $this->rng_keys();
        if (($this->flags() & Cmd::WRITE_CMD) && count($args) < 2)
            $args[] = $this->rng_key();

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
