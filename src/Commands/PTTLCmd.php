<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class PTTLCmd extends KeyCmd {
    use Traits\AnyType;
    use Traits\ReadCmd;
}
