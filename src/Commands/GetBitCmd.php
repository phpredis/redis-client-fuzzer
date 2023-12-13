<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class GetBitCmd extends KeyIntCmd {
    use Traits\StringCmd;
    use Traits\ReadCmd;

    public function get_int(): int {
        return rand(0, 8 * $this->context->strlen());
    }
}
