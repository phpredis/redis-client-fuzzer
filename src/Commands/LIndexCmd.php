<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LIndexCmd extends KeyIntCmd {
    use Traits\ListCmd;
    use Traits\ReadCmd;

    public function get_int(): int {
        return rand(0, $this->context->mems() - 1);
    }
}
