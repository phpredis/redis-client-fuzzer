<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class PExpireAtCmd extends ExpireAtGenericCmd {
    public function get_int(): int {
        return (time() * 1000) + rand(0, 60000);
    }
}

