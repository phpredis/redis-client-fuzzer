<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ZRevRangeByLexCmd extends ZRangeByLexGenericCmd {
    public function rng_lex_range(): array {
        list($a, $b) = parent::rng_lex_range();
        return [$b, $a];
    }
}
