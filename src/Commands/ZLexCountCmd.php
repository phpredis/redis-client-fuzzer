<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZLexCountCmd extends Cmd {
    use Traits\ZSetCmd;
    use Traits\ReadCmd;

    public function args(): array {
        list($lo, $hi) = $this->rng_lex_range();
        return [$this->rng_key(), $lo, $hi];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
