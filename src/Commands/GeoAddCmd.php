<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GeoAddCmd extends GeoCmd {
    use Traits\GeoCmd;
    use Traits\WriteCmd;

    public function args(): array {
        $args = [$this->rng_key()];

        for ($i = 0; $i < mt_rand(1, 5); $i++) {
            $args[] = $this->rng_longitude();
            $args[] = $this->rng_latitude();
            $args[] = $this->rng_mem();
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
