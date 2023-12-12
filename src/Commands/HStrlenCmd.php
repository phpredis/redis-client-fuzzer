<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HStrlenCmd extends KeyMemCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
