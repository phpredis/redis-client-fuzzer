<?php

namespace Phpredis\RedisClientFuzzer\Commands;

require_once __DIR__ . '/KeyCmd.php';

class SCardCmd extends KeyCmd {
    use Traits\ReadCmd;
    use Traits\SetCmd;
}
