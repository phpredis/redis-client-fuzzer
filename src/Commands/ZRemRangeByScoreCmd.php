<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRemRangeByScoreCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $lo = rand(0, 16384);
        $hi = $lo + rand(0, 16384);

        return [$this->rng_key(), $lo, $hi];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
