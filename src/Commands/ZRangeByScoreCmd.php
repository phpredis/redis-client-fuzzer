<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRangeByScoreCmd  extends ZRangeByScoreGenericCmd {
    protected function rng_range(): array {
        $min = rand(0, 32 * 1024);
        $max = rand($min, 32 * 1024);
        return [$min, $max];
    }
}
