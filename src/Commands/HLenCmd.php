<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class HLenCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
