<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LMoveCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    private $positions = ['LEFT', 'RIGHT'];

    private function rng_pos(): string {
        return $this->positions[array_rand($this->positions)];
    }

    public function args(): array {
        list($src, $dst) = $this->rng_slot_key_pair();
        return [$src, $dst, $this->rng_pos(), $this->rng_pos()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
