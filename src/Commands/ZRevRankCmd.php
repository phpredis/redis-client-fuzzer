<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRevRankCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $rank = rand(0, $this->context->mems());
        return [$this->rng_key(), rand(0, $this->context->mems()), $rank % 2 == 0];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
