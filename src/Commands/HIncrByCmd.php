<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HIncrByCmd extends KeyMemNumCmd {
    use Traits\WriteCmd;
    use Traits\HashCmd;

    public function get_num(): int|float {
        return rand(-100, 100);
    }

    public function rng_mem(): string {
        return 'int-' . parent::rng_mem();
    }
}
