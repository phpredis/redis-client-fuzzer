<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class LSetCmd extends KeyIntValCmd {
    use Traits\WriteCmd;
    use Traits\ListCmd;

    public function get_int(): int {
        return rand(0, $this->context->mems());
    }
}
