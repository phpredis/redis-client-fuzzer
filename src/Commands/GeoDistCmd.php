<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GeoDistCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\GeoCmd;

    private $units = ['M', 'KM', 'FT', 'MI'];

    public function args(): array {
        $args = [$this->rng_key(), $this->rng_mem(), $this->rng_mem()];
        if ($this->rng_choice()) {
            if ($this->rng_choice()) {
                $args[] = $this->units[array_rand($this->units)];
            } else {
                $args[] = NULL;
            }
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
