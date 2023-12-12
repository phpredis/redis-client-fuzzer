<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SRandMemberCmd extends KeyOptCountCmd {
    use Traits\SetCmd;
    use Traits\ReadCmd;

    public function get_count(): int {
        return rand(-1 * $this->context->mems(), $this->context->mems());
    }
}
