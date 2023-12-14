<?php

namespace Phpredis\RedisClientFuzzer\Commands;

abstract class ZPopCmd extends KeyIntCmd {
    use Traits\WriteCmd;
    use Traits\ZSetCmd;

    public function get_int(): int {
        return rand(1, $this->context->mems());
    }
}
