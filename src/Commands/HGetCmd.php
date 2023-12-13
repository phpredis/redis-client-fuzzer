<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HGetCmd extends KeyMemCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
