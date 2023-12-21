<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HRandFieldCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;

    /* Map our random number to an HRANDFIELD like count which can be
     * negative (of any value) or positive). */
    protected function rng_count($limit): int {
        return round(($this->rng() / $this->rng_max() * 2 * $limit) - $limit);
    }

    public function args(): array {
        $args = [$this->rng_key()];

        $rng = mt_rand();

        if ($this->rng_choice()) {
            if ($this->rng_choice()) {
                $opts['count'] = $this->rng_count($this->context->mems() * 2);
                if ($opts['count'] > 0 && $this->rng_choice());
                    $opts['withvalues'] = $this->rng_choice();
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
