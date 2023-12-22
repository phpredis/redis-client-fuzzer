<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZInterUnionStoreCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    private $agg = ['SUM', 'MIN', 'MAX'];

    public function args(): array {
        $args = [$this->rng_key()];

        $keys = $this->rng_keys();
        $args[] = $keys;

        if ($this->rng_choice()) {
            for ($i = 0; $i < count($keys); $i++) {
                $weights[] = mt_rand() / mt_getrandmax();
            }
            $args[] = $weights;

            if ($this->rng_choice()) {
                $args[] = $this->agg[array_rand($this->agg)];
            }
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->$args;
    }
}
