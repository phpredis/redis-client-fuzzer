<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class IncrByFloatCmd extends IncrDecrByCmd {
    public function value(): int|float {
        return mt_rand() / mt_getrandmax();
    }
};
