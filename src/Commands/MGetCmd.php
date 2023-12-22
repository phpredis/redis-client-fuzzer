<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class MGetCmd extends MKeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;

    public function rng_keys(bool $anyshard = false): array {
        return parent::rng_keys(true);
    }
}
