<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class GeoCmd extends Cmd {
    protected function rng_longitude() {
        return mt_rand(-180000000, 180000000) / 1000000;
    }

    protected function rng_latitude() {
        return mt_rand(-8505112878, 8505112878) / 100000000;
    }

    protected function rng_member() {
        return $this->rng_val();
    }
}
