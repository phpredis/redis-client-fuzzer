<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HRandFieldCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;

    /* Map our random number to an HRANDFIELD like count which can be
     * negative (of any value) or positive). */
    protected function rng_count($rng, $limit): int {
        return round(($rng / mt_getrandmax() * 2 * $limit) - $limit);
    }

    public function args(): array {
        $args = [$this->rng_key()];

        $rng = mt_rand();

        if (($rng & (1 << 0)) !== 0) {
            if (($rng & (1 << 1)) !== 0) {
                $opts['count'] = $this->rng_count($rng, $this->context->mems() * 2);
                if ($opts['count'] > 0 && ($rng & (1 << 2)) !== 0)
                    $opts['withvalues'] = ($rng & (1 << 3)) != 0;
            }

            if ( ! isset($opts))
                $opts = NULL;

            $args[] = $opts;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }

    public function cluster_args(): array {
        return $this->args();
    }
}
