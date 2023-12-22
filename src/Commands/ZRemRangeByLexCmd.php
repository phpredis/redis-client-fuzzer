<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRemRangeByLexCmd extends Cmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        return [$this->rng_key(), ...$this->rng_lex_range()];
    }

    public function raw_args(): array {
        return $this->args();
    }
}
