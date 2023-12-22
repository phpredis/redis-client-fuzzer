<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZInterUnionCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    private $agg = ['SUM', 'MIN', 'MAX'];

    public function args(): array {
        $keys = $this->rng_keys();
        $args[] = $keys;

        if ($this->rng_choice()) {
            for ($i = 0; $i < count($keys); $i++) {
                $weights[] = mt_rand() / mt_getrandmax();
            }

            $args[] = $weights;

            if ($this->rng_choice()) {
                $opts = [];
                if ($this->rng_choice()) {
                    $opts['aggregate'] = $this->agg[array_rand($this->agg)];
                }
                if ($this->rng_choice()) {
                    $opts['withscores'] = $this->rng_choice();
                }

                $args[] = $opts;
            }
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
