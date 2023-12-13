<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LTrimCmd extends RangeCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function args(): array {
        list($s, $e) = $this->rng_range($this->context->mems());
        return [$this->rng_key(), $s, $e];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
