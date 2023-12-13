<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class SetExCmd extends KeyIntValCmd {
    use Traits\StringCmd;
    use Traits\WriteCmd;

    public function get_int(): int {
        return rand(1, 60);
    }
}
