<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class StrLenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\StringCmd;
}
