<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HIncrByFloatCmd extends KeyMemNumCmd {
    use Traits\WriteCmd;
    use Traits\HashCmd;

    public function get_num(): int|float {
        return $this->rng_float(0, 1024);
    }

    public function rng_mem(): string {
        return 'dbl-' . parent::rng_mem();
    }
}

