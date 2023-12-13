<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class BitCountCmd extends RangeCmd {
    use Traits\StringCmd;
    use Traits\ReadCmd;

    public function args(): array {
        $by_bit = rand(1, 2) == 1;
        $maxlen = $this->context->strlen();
        if ($by_bit)
            $maxlen *= 8;

        list($s, $e) = $this->rng_range($maxlen);
        return [$this->get_key(), $s, $e, $by_bit];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
