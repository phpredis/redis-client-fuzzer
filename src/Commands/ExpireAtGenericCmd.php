<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ExpireAtGenericCmd extends KeyIntCmd {
    use Traits\AnyType;
    use Traits\WriteCmd;

    public function args(): array {
        return [$this->rng_key(), $this->get_int()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
