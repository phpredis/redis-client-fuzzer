<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class DelCmd extends MKeyCmd {
    use Traits\DelCmd;
    use Traits\AnyType;

    public function rng_keys(bool $anyshard = false): array {
        return parent::rng_keys(true);
    }
}
