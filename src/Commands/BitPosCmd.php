<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class BitPosCmd extends RangeCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;

    public function args(): array {
        $args = [$this->rng_key(), $this->rng_choice()];

        if ($this->rng_choice()) {
            list($start, $end) = $this->rng_range($this->context->strlen());
            if ($this->rng_choice()) {
                $args[] = $start;
                if ($this->rng_choice()) {
                    $args[] = $end;
                    if ($this->rng_choice())
                        $args[] = $this->rng_choice();
                }
            }
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
