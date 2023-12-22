<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZRangeByLexGenericCmd extends Cmd {
    use Traits\ReadCmd;
    use Traits\ZSetCmd;

    public function args(): array {
        $args = [$this->rng_key(), ...$this->rng_lex_range()];

        if ($this->rng_choice()) {
            $offset = rand(0, $this->context->mems());
            $limit = rand(0, $this->context->mems());
            $args[] = $offset;
            $args[] = $limit;
        }

        return $args;
    }

    public function raw_args(): array {
        return $this->args();
    }
}
