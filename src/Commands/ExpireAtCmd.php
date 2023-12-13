<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class ExpireAtCmd extends ExpireAtGenericCmd {
    public function get_int(): int {
        return time() + rand(0, 60);
    }
}

