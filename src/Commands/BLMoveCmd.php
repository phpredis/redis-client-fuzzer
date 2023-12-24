<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class BLMoveCmd extends Cmd {
    use Traits\BlockingWriteCmd;
    use Traits\ListCmd;

    private $positions = ['LEFT', 'RIGHT'];

    protected function rng_pos() {
        return $this->positions[array_rand($this->positions)];
    }

    public function args(): array {
        return [
            $this->rng_key(), $this->rng_key(), $this->rng_pos(), $this->rng_pos(),
            $this->rng_float(0.001, 0.004)
        ];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
