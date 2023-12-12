<?php

namespace Phpredis\RedisClientFuzzer\Commands;

class HExistsCmd extends KeyMemCmd {
    use Traits\ReadCmd;
    use Traits\HashCmd;
}
